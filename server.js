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
  updateCompanyInfo,
  updateAboutSection,
  updateService,
  addService,
  deleteService
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

// ==========================================
// ADMIN PANEL ROUTES
// ==========================================

// 1. Admin Login View
app.get('/admin/login', (req, res) => {
  if (req.session && req.session.isAdmin) {
    return res.redirect('/admin');
  }
  res.render('admin/login', { error: null });
});

// 2. Admin Login Action
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

// 3. Admin Logout Action
app.post('/admin/logout', (req, res) => {
  req.session.destroy(err => {
    res.redirect('/admin/login');
  });
});

app.get('/admin/logout', (req, res) => {
  req.session.destroy(err => {
    res.redirect('/admin/login');
  });
});

// 4. Admin Dashboard (Manage Company, About, Services)
app.get('/admin', requireAdmin, async (req, res) => {
  try {
    const { company, about, services } = await getAllData();
    const activeTab = req.query.tab || 'company';
    const successMsg = req.query.success || null;
    const errorMsg = req.query.error || null;

    res.render('admin/dashboard', {
      company,
      about,
      services,
      activeTab,
      success: successMsg,
      error: errorMsg,
      adminUser: req.session.adminUser || 'admin'
    });
  } catch (err) {
    console.error('Error rendering admin dashboard:', err);
    res.status(500).send('Internal Server Error');
  }
});

// 5. Admin: Update Company Info
app.post('/admin/company', requireAdmin, async (req, res) => {
  try {
    await updateCompanyInfo(req.body);
    res.redirect('/admin?tab=company&success=' + encodeURIComponent('Company Information updated successfully!'));
  } catch (err) {
    console.error('Admin company update error:', err);
    res.redirect('/admin?tab=company&error=' + encodeURIComponent(err.message));
  }
});

// 6. Admin: Update About Section
app.post('/admin/about', requireAdmin, async (req, res) => {
  try {
    await updateAboutSection(req.body);
    res.redirect('/admin?tab=about&success=' + encodeURIComponent('About Section updated successfully!'));
  } catch (err) {
    console.error('Admin about update error:', err);
    res.redirect('/admin?tab=about&error=' + encodeURIComponent(err.message));
  }
});

// 7. Admin: Add New Service
app.post('/admin/services', requireAdmin, async (req, res) => {
  try {
    const { number_label, title_en, title_ja, desc_en, desc_ja, items_en, items_ja, sort_order } = req.body;
    
    // Parse multiline string to array
    const parseList = (str) => {
      if (!str) return [];
      return str.split('\n').map(s => s.trim()).filter(Boolean);
    };

    await addService({
      number_label,
      title_en,
      title_ja,
      desc_en,
      desc_ja,
      items_en: parseList(items_en),
      items_ja: parseList(items_ja),
      sort_order: parseInt(sort_order, 10) || 0
    });

    res.redirect('/admin?tab=services&success=' + encodeURIComponent('New service added successfully!'));
  } catch (err) {
    console.error('Admin add service error:', err);
    res.redirect('/admin?tab=services&error=' + encodeURIComponent(err.message));
  }
});

// 8. Admin: Update Existing Service
app.post('/admin/services/:id', requireAdmin, async (req, res) => {
  try {
    const { number_label, title_en, title_ja, desc_en, desc_ja, items_en, items_ja, sort_order } = req.body;

    const parseList = (input) => {
      if (Array.isArray(input)) return input;
      if (!input) return [];
      return input.split('\n').map(s => s.trim()).filter(Boolean);
    };

    await updateService(req.params.id, {
      number_label,
      title_en,
      title_ja,
      desc_en,
      desc_ja,
      items_en: parseList(items_en),
      items_ja: parseList(items_ja),
      sort_order: parseInt(sort_order, 10) || 0
    });

    res.redirect('/admin?tab=services&success=' + encodeURIComponent('Service #' + number_label + ' updated successfully!'));
  } catch (err) {
    console.error('Admin update service error:', err);
    res.redirect('/admin?tab=services&error=' + encodeURIComponent(err.message));
  }
});

// 9. Admin: Delete Service
app.post('/admin/services/:id/delete', requireAdmin, async (req, res) => {
  try {
    await deleteService(req.params.id);
    res.redirect('/admin?tab=services&success=' + encodeURIComponent('Service deleted successfully!'));
  } catch (err) {
    console.error('Admin delete service error:', err);
    res.redirect('/admin?tab=services&error=' + encodeURIComponent(err.message));
  }
});

// ==========================================
// PUBLIC FRONTEND ROUTES
// ==========================================

// Main dynamic landing page route
app.get('/', async (req, res) => {
  try {
    const { company, about, services, dbStatus } = await getAllData();
    res.render('home', {
      company,
      about,
      services,
      dbStatus,
      isAdmin: Boolean(req.session && req.session.isAdmin),
      license: company.license || '13-ユ-319558',
      year: new Date().getFullYear()
    });
  } catch (err) {
    console.error('Error rendering page:', err);
    res.status(500).send('Internal Server Error');
  }
});


// JSON API endpoints
app.get('/api/data', async (req, res) => {
  try {
    const data = await getAllData();
    res.json({ success: true, data });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.get('/api/company', async (req, res) => {
  try {
    const company = await getCompanyInfo();
    res.json({ success: true, data: company });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.put('/api/company', async (req, res) => {
  try {
    const updated = await updateCompanyInfo(req.body);
    res.json({ success: true, message: 'Company information updated', data: updated });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.get('/api/about', async (req, res) => {
  try {
    const about = await getAboutSection();
    res.json({ success: true, data: about });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.put('/api/about', async (req, res) => {
  try {
    const updated = await updateAboutSection(req.body);
    res.json({ success: true, message: 'About section updated', data: updated });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.get('/api/services', async (req, res) => {
  try {
    const services = await getServices();
    res.json({ success: true, data: services });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.put('/api/services/:id', async (req, res) => {
  try {
    const services = await updateService(req.params.id, req.body);
    res.json({ success: true, message: 'Service updated', data: services });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

app.post('/api/services', async (req, res) => {
  try {
    const service = await addService(req.body);
    res.json({ success: true, message: 'Service added', data: service });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// Database health / status endpoint
app.get('/api/db/status', async (req, res) => {
  const isOk = await initDatabase();
  res.json({
    connected: isOk,
    config: {
      host: process.env.DB_HOST || '127.0.0.1',
      port: process.env.DB_PORT || '3306',
      database: process.env.DB_DATABASE || 'miransh',
      user: process.env.DB_USERNAME || process.env.DB_USER || 'root'
    }
  });
});

// Initialize database on startup
initDatabase().catch(err => {
  console.warn('[DB Init] Startup connection check:', err.message);
});

app.listen(PORT, '0.0.0.0', () => {
  console.log(`MIRANSH server running on http://0.0.0.0:${PORT}`);
});
