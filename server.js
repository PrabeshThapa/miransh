import express from 'express';
import session from 'express-session';
import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';
import dotenv from 'dotenv';
import multer from 'multer';
import {
  initDatabase,
  getAllData,
  getCompanyInfo,
  getAboutSection,
  getServices,
  getServiceById,
  getStories,
  getStoryById,
  getInquiries,
  addInquiry,
  updateCompanyInfo,
  updateAboutSection,
  updateService,
  addService,
  deleteService,
  addStory,
  updateStory,
  deleteStory
} from './db.js';
import {
  getSakanaConfig,
  updateSakanaConfig,
  testSakanaConnection,
  chatWithSakana,
  generateAiInquiryReply,
  evaluateCandidateMatch
} from './sakana.js';

dotenv.config();

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;

// Ensure public/uploads directory exists for actual image uploads
const uploadsDir = path.join(__dirname, 'public', 'uploads');
if (!fs.existsSync(uploadsDir)) {
  fs.mkdirSync(uploadsDir, { recursive: true });
}

// Multer Storage Configuration
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    if (!fs.existsSync(uploadsDir)) {
      fs.mkdirSync(uploadsDir, { recursive: true });
    }
    cb(null, uploadsDir);
  },
  filename: function (req, file, cb) {
    const ext = path.extname(file.originalname).toLowerCase() || '.jpg';
    const cleanBaseName = path.basename(file.originalname, ext).replace(/[^a-zA-Z0-9_-]/g, '_');
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1e6);
    cb(null, `${cleanBaseName || 'img'}-${uniqueSuffix}${ext}`);
  }
});

const fileFilter = (req, file, cb) => {
  const allowedExts = /jpeg|jpg|png|webp|gif|svg/;
  const isExtAllowed = allowedExts.test(path.extname(file.originalname).toLowerCase());
  const isMimeAllowed = allowedExts.test(file.mimetype) || file.mimetype.startsWith('image/');
  if (isExtAllowed || isMimeAllowed) {
    cb(null, true);
  } else {
    cb(new Error('Only image files (JPG, PNG, WEBP, GIF, SVG) are allowed'));
  }
};

const upload = multer({
  storage,
  fileFilter,
  limits: { fileSize: 15 * 1024 * 1024 } // 15MB limit
});

// Helper to list all available media assets
function getAvailableMedia() {
  const mediaList = [];
  const publicDir = path.join(__dirname, 'public');
  
  // 1. Preset images in /public/images
  const imagesDir = path.join(publicDir, 'images');
  if (fs.existsSync(imagesDir)) {
    const files = fs.readdirSync(imagesDir);
    files.forEach(f => {
      if (/\.(jpg|jpeg|png|webp|gif|svg)$/i.test(f)) {
        mediaList.push({
          url: `/images/${f}`,
          name: f,
          isUploaded: false,
          size: 'Built-in',
          category: 'プリセット (Preset)'
        });
      }
    });
  }

  // 2. User uploaded images in /public/uploads
  if (fs.existsSync(uploadsDir)) {
    const uFiles = fs.readdirSync(uploadsDir);
    uFiles.forEach(f => {
      if (/\.(jpg|jpeg|png|webp|gif|svg)$/i.test(f)) {
        try {
          const stat = fs.statSync(path.join(uploadsDir, f));
          mediaList.push({
            url: `/uploads/${f}`,
            name: f,
            isUploaded: true,
            size: Math.round(stat.size / 1024) + ' KB',
            createdAt: stat.mtime,
            category: 'アップロード済 (Uploaded)'
          });
        } catch (e) {
          // ignore stat errors
        }
      }
    });
  }

  return mediaList;
}

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.use(express.json({ limit: '20mb' }));
app.use(express.urlencoded({ extended: true, limit: '20mb' }));
app.use(express.static(path.join(__dirname, 'public')));

// Admin Session Middleware
app.use(
  session({
    secret: process.env.SESSION_SECRET || 'miransh_admin_secret_key_2026_secure',
    resave: false,
    saveUninitialized: false,
    cookie: {
      maxAge: 1000 * 60 * 60 * 24, // 24 hours
      httpOnly: true
    }
  })
);

// Admin Authentication Middleware
function requireAdmin(req, res, next) {
  if (req.session && req.session.isAdmin) {
    return next();
  }
  return res.redirect('/admin/login');
}

// 1. Public Home Page
app.get('/', async (req, res) => {
  try {
    const data = await getAllData();
    res.render('home', {
      company: data.company,
      about: data.about,
      services: data.services,
      stories: data.stories,
      query: req.query
    });
  } catch (err) {
    console.error('Error rendering home page:', err);
    res.status(500).send('Internal Server Error');
  }
});

// 2. Service Detail Page (On click service show on dedicated page)
app.get('/services/:id', async (req, res) => {
  try {
    const service = await getServiceById(req.params.id);
    if (!service) {
      return res.redirect('/#services');
    }
    const [company, allServices] = await Promise.all([
      getCompanyInfo(),
      getServices()
    ]);
    res.render('service-detail', {
      service,
      company,
      allServices,
      query: req.query
    });
  } catch (err) {
    console.error('Error rendering service detail:', err);
    res.redirect('/');
  }
});

// 3. Story Detail Page
app.get('/stories/:id', async (req, res) => {
  try {
    const story = await getStoryById(req.params.id);
    if (!story) {
      return res.redirect('/#stories');
    }
    const [company, allStories] = await Promise.all([
      getCompanyInfo(),
      getStories()
    ]);
    res.render('story-detail', {
      story,
      company,
      allStories,
      query: req.query
    });
  } catch (err) {
    console.error('Error rendering story detail:', err);
    res.redirect('/');
  }
});

// 4. Contact Form Submission
app.post('/contact', async (req, res) => {
  try {
    const { name, company_name, email, phone, service_interest, message } = req.body;
    await addInquiry({
      name,
      company_name,
      email,
      phone,
      service_interest,
      message
    });
    if (req.xhr || req.headers.accept?.includes('json')) {
      return res.json({ success: true, message: 'Your message has been sent successfully.' });
    }
    res.redirect('/?submitted=true#contact');
  } catch (err) {
    console.error('Error handling contact form:', err);
    res.redirect('/?error=true#contact');
  }
});

// 5. Admin Authentication
app.get('/admin/login', (req, res) => {
  if (req.session && req.session.isAdmin) {
    return res.redirect('/admin');
  }
  res.render('admin/login', { error: null });
});

app.post('/admin/login', (req, res) => {
  const { username, password } = req.body;
  const adminUser = process.env.ADMIN_USER || 'admin';
  const adminPass = process.env.ADMIN_PASSWORD || 'admin123';

  if (
    (username === adminUser || username === 'admin@miransh.jp') &&
    password === adminPass
  ) {
    req.session.isAdmin = true;
    req.session.adminUser = username;
    return res.redirect('/admin');
  }

  res.render('admin/login', {
    error: 'Invalid credentials. Please check your username and password.'
  });
});

app.post('/admin/logout', (req, res) => {
  req.session.destroy(() => {
    res.redirect('/admin/login');
  });
});

app.get('/admin/logout', (req, res) => {
  req.session.destroy(() => {
    res.redirect('/admin/login');
  });
});

// 6. Admin Dashboard
app.get('/admin', requireAdmin, async (req, res) => {
  try {
    const data = await getAllData();
    const mediaList = getAvailableMedia();
    const sakanaConfig = getSakanaConfig();
    const message = req.session.flashMessage || null;
    req.session.flashMessage = null;
    res.render('admin/dashboard', {
      company: data.company,
      about: data.about,
      services: data.services,
      stories: data.stories,
      inquiries: data.inquiries,
      dbStatus: data.dbStatus,
      mediaList,
      sakanaConfig,
      message
    });
  } catch (err) {
    console.error('Error loading admin dashboard:', err);
    res.status(500).send('Admin Dashboard Error');
  }
});

// 6.1 Admin Direct AJAX Image Upload Endpoint
app.post('/admin/upload-image', requireAdmin, (req, res) => {
  upload.single('image')(req, res, (err) => {
    if (err) {
      console.error('Upload Error:', err);
      return res.status(400).json({ success: false, error: err.message });
    }
    if (!req.file) {
      return res.status(400).json({ success: false, error: 'No image file received' });
    }

    const imageUrl = `/uploads/${req.file.filename}`;
    return res.json({
      success: true,
      url: imageUrl,
      filename: req.file.filename,
      size: `${Math.round(req.file.size / 1024)} KB`
    });
  });
});

// 6.2 Admin Media API
app.get('/admin/api/media', requireAdmin, (req, res) => {
  try {
    const media = getAvailableMedia();
    res.json({ success: true, media });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.post('/admin/api/media/delete', requireAdmin, (req, res) => {
  try {
    const { filename } = req.body;
    if (!filename || filename.includes('..') || filename.includes('/')) {
      return res.status(400).json({ success: false, error: 'Invalid filename' });
    }
    const targetPath = path.join(uploadsDir, filename);
    if (fs.existsSync(targetPath)) {
      fs.unlinkSync(targetPath);
      return res.json({ success: true, message: 'Image deleted successfully' });
    }
    return res.status(404).json({ success: false, error: 'File not found' });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// 7. Admin Update Company Info & Photos
app.post('/admin/company', requireAdmin, (req, res) => {
  const uploadFields = upload.fields([
    { name: 'ceo_image_file', maxCount: 1 },
    { name: 'hero_image_file', maxCount: 1 }
  ]);

  uploadFields(req, res, async (err) => {
    if (err) {
      req.session.flashMessage = {
        type: 'error',
        text: 'Image upload failed: ' + err.message
      };
      return res.redirect('/admin#company-tab');
    }

    try {
      const payload = { ...req.body };

      // If a new CEO image was uploaded via file input
      if (req.files && req.files.ceo_image_file && req.files.ceo_image_file[0]) {
        payload.ceo_image = `/uploads/${req.files.ceo_image_file[0].filename}`;
      }

      // If a new Hero banner was uploaded via file input
      if (req.files && req.files.hero_image_file && req.files.hero_image_file[0]) {
        payload.hero_image = `/uploads/${req.files.hero_image_file[0].filename}`;
      }

      await updateCompanyInfo(payload);
      req.session.flashMessage = {
        type: 'success',
        text: '会社情報・写真・ヒーロー設定を更新しました。(Company Profile & Images Saved!)'
      };
    } catch (dbErr) {
      console.error('Error updating company:', dbErr);
      req.session.flashMessage = {
        type: 'error',
        text: 'Failed to update company info: ' + dbErr.message
      };
    }
    res.redirect('/admin#company-tab');
  });
});

// 8. Admin Update About
app.post('/admin/about', requireAdmin, async (req, res) => {
  try {
    await updateAboutSection(req.body);
    req.session.flashMessage = {
      type: 'success',
      text: 'About Us section updated successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to update about section: ' + err.message
    };
  }
  res.redirect('/admin#about-tab');
});

// 9. Admin Services CRUD
app.post('/admin/services', requireAdmin, async (req, res) => {
  try {
    const itemsEn = req.body.items_en ? req.body.items_en.split('\n').map(s => s.trim()).filter(Boolean) : [];
    const itemsJa = req.body.items_ja ? req.body.items_ja.split('\n').map(s => s.trim()).filter(Boolean) : [];
    const stepsEn = req.body.workflow_steps_en ? req.body.workflow_steps_en.split('\n').map(s => s.trim()).filter(Boolean) : [];
    const stepsJa = req.body.workflow_steps_ja ? req.body.workflow_steps_ja.split('\n').map(s => s.trim()).filter(Boolean) : [];

    await addService({
      ...req.body,
      items_en: itemsEn,
      items_ja: itemsJa,
      workflow_steps_en: stepsEn,
      workflow_steps_ja: stepsJa
    });
    req.session.flashMessage = {
      type: 'success',
      text: 'New service created successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to create service: ' + err.message
    };
  }
  res.redirect('/admin#services-tab');
});

app.post('/admin/services/:id', requireAdmin, async (req, res) => {
  try {
    const itemsEn = typeof req.body.items_en === 'string'
      ? req.body.items_en.split('\n').map(s => s.trim()).filter(Boolean)
      : (req.body.items_en || []);
    const itemsJa = typeof req.body.items_ja === 'string'
      ? req.body.items_ja.split('\n').map(s => s.trim()).filter(Boolean)
      : (req.body.items_ja || []);
    const stepsEn = typeof req.body.workflow_steps_en === 'string'
      ? req.body.workflow_steps_en.split('\n').map(s => s.trim()).filter(Boolean)
      : (req.body.workflow_steps_en || []);
    const stepsJa = typeof req.body.workflow_steps_ja === 'string'
      ? req.body.workflow_steps_ja.split('\n').map(s => s.trim()).filter(Boolean)
      : (req.body.workflow_steps_ja || []);

    await updateService(req.params.id, {
      ...req.body,
      items_en: itemsEn,
      items_ja: itemsJa,
      workflow_steps_en: stepsEn,
      workflow_steps_ja: stepsJa
    });
    req.session.flashMessage = {
      type: 'success',
      text: 'Service updated successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to update service: ' + err.message
    };
  }
  res.redirect('/admin#services-tab');
});

app.post('/admin/services/:id/delete', requireAdmin, async (req, res) => {
  try {
    await deleteService(req.params.id);
    req.session.flashMessage = {
      type: 'success',
      text: 'Service deleted successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to delete service: ' + err.message
    };
  }
  res.redirect('/admin#services-tab');
});

// 10. Admin Stories CRUD (with image file upload support)
app.post('/admin/stories', requireAdmin, (req, res) => {
  upload.single('image_file')(req, res, async (err) => {
    if (err) {
      req.session.flashMessage = {
        type: 'error',
        text: 'Image upload failed: ' + err.message
      };
      return res.redirect('/admin#stories-tab');
    }

    try {
      const payload = { ...req.body };
      if (req.file) {
        payload.image = `/uploads/${req.file.filename}`;
      }

      await addStory(payload);
      req.session.flashMessage = {
        type: 'success',
        text: '採用事例・ニュースを投稿しました。(Story Published!)'
      };
    } catch (dbErr) {
      console.error('Error creating story:', dbErr);
      req.session.flashMessage = {
        type: 'error',
        text: 'Failed to create story: ' + dbErr.message
      };
    }
    res.redirect('/admin#stories-tab');
  });
});

app.post('/admin/stories/:id', requireAdmin, (req, res) => {
  upload.single('image_file')(req, res, async (err) => {
    if (err) {
      req.session.flashMessage = {
        type: 'error',
        text: 'Image upload failed: ' + err.message
      };
      return res.redirect('/admin#stories-tab');
    }

    try {
      const payload = { ...req.body };
      if (req.file) {
        payload.image = `/uploads/${req.file.filename}`;
      }

      await updateStory(req.params.id, payload);
      req.session.flashMessage = {
        type: 'success',
        text: '記事を更新しました。(Story updated!)'
      };
    } catch (dbErr) {
      console.error('Error updating story:', dbErr);
      req.session.flashMessage = {
        type: 'error',
        text: 'Failed to update story: ' + dbErr.message
      };
    }
    res.redirect('/admin#stories-tab');
  });
});

app.post('/admin/stories/:id/delete', requireAdmin, async (req, res) => {
  try {
    await deleteStory(req.params.id);
    req.session.flashMessage = {
      type: 'success',
      text: 'Story deleted successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to delete story: ' + err.message
    };
  }
  res.redirect('/admin#stories-tab');
});

// =========================================================================
// 11. SAKANA AI INTEGRATION API ENDPOINTS (Public & Admin)
// =========================================================================

// Public AI Chat Endpoint (for interactive website consultant)
app.post('/api/ai/chat', async (req, res) => {
  try {
    const { messages, language = 'ja', context = {} } = req.body;
    if (!messages || !Array.isArray(messages) || messages.length === 0) {
      return res.status(400).json({ success: false, error: 'Messages array is required' });
    }

    const result = await chatWithSakana({ messages, language, context });
    res.json({
      success: true,
      ...result
    });
  } catch (err) {
    console.error('Public AI Chat Error:', err);
    res.status(500).json({
      success: false,
      error: 'AI consultation service is currently unavailable. Please use the contact form.'
    });
  }
});

// Admin API: Test Sakana AI Connection & Retrieve Models
app.get('/admin/api/sakana/test', requireAdmin, async (req, res) => {
  try {
    const result = await testSakanaConnection();
    res.json(result);
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// Admin API: Save / Update Sakana AI Configuration
app.post('/admin/api/sakana/config', requireAdmin, async (req, res) => {
  try {
    const { apiKey, model, baseUrl } = req.body;
    const updated = updateSakanaConfig({ apiKey, model, baseUrl });
    const testResult = await testSakanaConnection(apiKey, model);
    res.json({
      success: true,
      config: updated,
      testResult,
      message: 'Sakana AI configuration updated successfully.'
    });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// Admin API: Generate Inquiry Response Draft with Sakana AI
app.post('/admin/api/sakana/generate-reply', requireAdmin, async (req, res) => {
  try {
    const { inquiry, tone = 'polite', language = 'ja' } = req.body;
    if (!inquiry) {
      return res.status(400).json({ success: false, error: 'Inquiry details required' });
    }
    const result = await generateAiInquiryReply({ inquiry, tone, language });
    res.json({ success: true, ...result });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// Admin API: Candidate & Job Requirement Analysis
app.post('/admin/api/sakana/candidate-match', requireAdmin, async (req, res) => {
  try {
    const { sector, jlptLevel, headcount, timeline, specialNotes } = req.body;
    const result = await evaluateCandidateMatch({ sector, jlptLevel, headcount, timeline, specialNotes });
    res.json({ success: true, ...result });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// Start Server
async function start() {
  await initDatabase();
  app.listen(PORT, '0.0.0.0', () => {
    console.log(`[MIRANSH Corporate Server] Running on http://localhost:${PORT}`);
  });
}

start();
