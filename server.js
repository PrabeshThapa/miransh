import express from 'express';
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
  addService
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

// Main dynamic landing page route
app.get('/', async (req, res) => {
  try {
    const { company, about, services, dbStatus } = await getAllData();
    res.render('home', {
      company,
      about,
      services,
      dbStatus,
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
