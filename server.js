import express from 'express';
import session from 'express-session';
import path from 'path';
import { fileURLToPath } from 'url';
import dotenv from 'dotenv';
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

dotenv.config();

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
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
    const message = req.session.flashMessage || null;
    req.session.flashMessage = null;
    res.render('admin/dashboard', {
      company: data.company,
      about: data.about,
      services: data.services,
      stories: data.stories,
      inquiries: data.inquiries,
      dbStatus: data.dbStatus,
      message
    });
  } catch (err) {
    console.error('Error loading admin dashboard:', err);
    res.status(500).send('Admin Dashboard Error');
  }
});

// 7. Admin Update Company Info & Photos
app.post('/admin/company', requireAdmin, async (req, res) => {
  try {
    await updateCompanyInfo(req.body);
    req.session.flashMessage = {
      type: 'success',
      text: 'Company Profile & Executive Media updated successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to update company info: ' + err.message
    };
  }
  res.redirect('/admin#company-tab');
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

// 10. Admin Stories CRUD
app.post('/admin/stories', requireAdmin, async (req, res) => {
  try {
    await addStory(req.body);
    req.session.flashMessage = {
      type: 'success',
      text: 'New Story / Case Study published successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to create story: ' + err.message
    };
  }
  res.redirect('/admin#stories-tab');
});

app.post('/admin/stories/:id', requireAdmin, async (req, res) => {
  try {
    await updateStory(req.params.id, req.body);
    req.session.flashMessage = {
      type: 'success',
      text: 'Story updated successfully!'
    };
  } catch (err) {
    req.session.flashMessage = {
      type: 'error',
      text: 'Failed to update story: ' + err.message
    };
  }
  res.redirect('/admin#stories-tab');
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

// Start Server
async function start() {
  await initDatabase();
  app.listen(PORT, '0.0.0.0', () => {
    console.log(`[MIRANSH Corporate Server] Running on http://localhost:${PORT}`);
  });
}

start();
