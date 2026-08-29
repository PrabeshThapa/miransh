import mysql from 'mysql2/promise';
import dotenv from 'dotenv';

dotenv.config();

const DB_CONFIG = {
  host: process.env.DB_HOST || '127.0.0.1',
  port: parseInt(process.env.DB_PORT || '3306', 10),
  user: process.env.DB_USERNAME || process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_DATABASE || 'miransh',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
  connectTimeout: 3000
};

// Initial default seed data
const DEFAULT_COMPANY_INFO = {
  id: 1,
  name_en: 'MIRANSH LLC',
  name_ja: 'ミランス合同会社',
  tagline_en: 'International Human Resources & Student Support',
  tagline_ja: '国際人材紹介・留学生紹介',
  location_en: 'Koganei-shi, Tokyo, Japan',
  location_ja: '東京都小金井市',
  phone: '042-409-8256',
  business_en: 'Foreign Worker Recruitment, Visa Support, Life Support, International Student Support',
  business_ja: '外国人材紹介、ビザサポート、ライフサポート、留学生紹介',
  license: '13-ユ-319558',
  ceo_name: 'RK Giri',
  ceo_role_en: 'CEO / Representative of MIRANSH LLC',
  ceo_role_ja: 'ミランス合同会社 代表者',
  hero_title_en: 'Connecting Japan',
  hero_title_accent_en: 'Global Talent',
  hero_desc_en: 'We at MIRANSH LLC aim to be a bridge between Japan and the international community, contributing to the creation of a beautiful society where all people can help one another and live happily.',
  hero_title_ja: '日本と世界を',
  hero_title_accent_ja: 'つなぐ会社',
  hero_desc_ja: 'ミランス合同会社は、日本と国際社会をつなぐ架け橋となり、すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。',
  hero_image: '/images/abc.jpeg',
  footer_text_en: 'International Human Resources & Student Support. Connecting Japan with international talent and students.',
  footer_text_ja: '国際人材紹介・留学生紹介。日本と世界の人材・留学生をつなぎます。'
};

const DEFAULT_ABOUT = {
  id: 1,
  badge_en: 'About MIRANSH',
  badge_ja: 'MIRANSHについて',
  heading_en: 'Building Bridges Between Japan and the World',
  heading_ja: '日本と世界をつなぐ架け橋',
  subheading_en: 'Supporting people who want to work, study and build their future in Japan.',
  subheading_ja: '日本で働きたい、学びたい、将来を築きたい外国人の皆様をサポートします。',
  title_en: 'MIRANSH LLC',
  title_ja: 'ミランス合同会社',
  desc1_en: 'We partner with educational institutions abroad to support foreigners, primarily from Nepal, who have passed the Japanese Language Proficiency Test and/or specific skills tests, or hold a university degree, in their search for employment or study in Japan.',
  desc1_ja: '海外の教育機関と連携し、主にネパールをはじめとする外国人の方々を対象に、日本語能力試験（JLPT）や特定技能試験に合格された方、または大学を卒業された方の日本での就職・就学をサポートしています。',
  desc2_en: 'We provide support with visa applications, preparations for coming to Japan, and daily life and living support after arriving in Japan.',
  desc2_ja: 'ビザ申請、日本へ来日するための準備、そして日本での生活・暮らしに関するライフサポートも行っています。',
  quote_en: '"We aim to contribute to a beautiful society where all people can help one another and live happily."',
  quote_ja: '「すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。」'
};

const DEFAULT_SERVICES = [
  {
    id: 1,
    number_label: '01',
    title_en: 'Foreign Worker Recruitment',
    title_ja: '国際人材紹介',
    desc_en: 'We help Nepali and other foreign nationals find employment with Japanese companies.',
    desc_ja: '日本語能力試験（JLPT）合格者、特定技能（Tokutei Ginou）合格者、または大学卒業者など、ネパールをはじめとする外国人の方々の日本企業への就職をサポートします。',
    items_en: [
      'JLPT-qualified candidates',
      'Specified Skilled Worker (Tokutei Ginou) candidates',
      'University graduates',
      'Employment opportunities with Japanese companies',
      'Visa application support',
      'Preparation for coming to Japan',
      'Life and daily living support in Japan'
    ],
    items_ja: [
      'JLPT合格者',
      '特定技能（Tokutei Ginou）合格者',
      '大学卒業者',
      '日本企業への就職支援',
      'ビザ申請サポート',
      '来日前の準備サポート',
      '日本での生活・ライフサポート'
    ],
    sort_order: 1
  },
  {
    id: 2,
    number_label: '02',
    title_en: 'International Student Support',
    title_ja: '留学生紹介',
    desc_en: 'We support foreign students who wish to come to Japan for education by helping them with admission to Japanese educational institutions.',
    desc_ja: 'ネパールおよびその他の国の教育機関と連携し、日本で学びたい外国人留学生の皆様の進学・入学をサポートします。',
    items_en: [
      'Partnerships with educational institutions in Nepal and other countries',
      'Japanese Language School admission support',
      'College admission support',
      'Study-in-Japan consultation',
      'Admission preparation support'
    ],
    items_ja: [
      'ネパール・海外の教育機関との提携',
      '日本語学校への入学支援',
      '専門学校・大学等への進学支援',
      '日本留学に関する相談',
      '入学準備サポート'
    ],
    sort_order: 2
  }
];

let fallbackCompanyInfo = { ...DEFAULT_COMPANY_INFO };
let fallbackAbout = { ...DEFAULT_ABOUT };
let fallbackServices = JSON.parse(JSON.stringify(DEFAULT_SERVICES));

let pool = null;
let isConnected = false;

export function getPool() {
  if (!pool) {
    pool = mysql.createPool(DB_CONFIG);
  }
  return pool;
}

export async function initDatabase() {
  try {
    // 1. Check if database server is reachable, create database if not exists
    const rootConnection = await mysql.createConnection({
      host: DB_CONFIG.host,
      port: DB_CONFIG.port,
      user: DB_CONFIG.user,
      password: DB_CONFIG.password,
      connectTimeout: 3000
    });

    await rootConnection.query(`CREATE DATABASE IF NOT EXISTS \`${DB_CONFIG.database}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`);
    await rootConnection.end();

    const db = getPool();
    const conn = await db.getConnection();

    // 2. Create tables
    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`company_info\` (
        \`id\` INT AUTO_INCREMENT PRIMARY KEY,
        \`name_en\` VARCHAR(255) NOT NULL DEFAULT 'MIRANSH LLC',
        \`name_ja\` VARCHAR(255) NOT NULL DEFAULT 'ミランス合同会社',
        \`tagline_en\` VARCHAR(255) NOT NULL DEFAULT 'International Human Resources & Student Support',
        \`tagline_ja\` VARCHAR(255) NOT NULL DEFAULT '国際人材紹介・留学生紹介',
        \`location_en\` VARCHAR(255) NOT NULL DEFAULT 'Koganei-shi, Tokyo, Japan',
        \`location_ja\` VARCHAR(255) NOT NULL DEFAULT '東京都小金井市',
        \`phone\` VARCHAR(50) NOT NULL DEFAULT '042-409-8256',
        \`business_en\` TEXT NOT NULL,
        \`business_ja\` TEXT NOT NULL,
        \`license\` VARCHAR(100) NOT NULL DEFAULT '13-ユ-319558',
        \`ceo_name\` VARCHAR(100) NOT NULL DEFAULT 'RK Giri',
        \`ceo_role_en\` VARCHAR(255) NOT NULL DEFAULT 'CEO / Representative of MIRANSH LLC',
        \`ceo_role_ja\` VARCHAR(255) NOT NULL DEFAULT 'ミランス合同会社 代表者',
        \`hero_title_en\` VARCHAR(255) NOT NULL DEFAULT 'Connecting Japan',
        \`hero_title_accent_en\` VARCHAR(255) NOT NULL DEFAULT 'Global Talent',
        \`hero_desc_en\` TEXT NOT NULL,
        \`hero_title_ja\` VARCHAR(255) NOT NULL DEFAULT '日本と世界を',
        \`hero_title_accent_ja\` VARCHAR(255) NOT NULL DEFAULT 'つなぐ会社',
        \`hero_desc_ja\` TEXT NOT NULL,
        \`hero_image\` VARCHAR(255) NOT NULL DEFAULT '/images/abc.jpeg',
        \`footer_text_en\` TEXT NOT NULL,
        \`footer_text_ja\` TEXT NOT NULL,
        \`created_at\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        \`updated_at\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`abouts\` (
        \`id\` INT AUTO_INCREMENT PRIMARY KEY,
        \`badge_en\` VARCHAR(100) NOT NULL DEFAULT 'About MIRANSH',
        \`badge_ja\` VARCHAR(100) NOT NULL DEFAULT 'MIRANSHについて',
        \`heading_en\` VARCHAR(255) NOT NULL DEFAULT 'Building Bridges Between Japan and the World',
        \`heading_ja\` VARCHAR(255) NOT NULL DEFAULT '日本と世界をつなぐ架け橋',
        \`subheading_en\` TEXT NOT NULL,
        \`subheading_ja\` TEXT NOT NULL,
        \`title_en\` VARCHAR(255) NOT NULL DEFAULT 'MIRANSH LLC',
        \`title_ja\` VARCHAR(255) NOT NULL DEFAULT 'ミランス合同会社',
        \`desc1_en\` TEXT NOT NULL,
        \`desc1_ja\` TEXT NOT NULL,
        \`desc2_en\` TEXT NOT NULL,
        \`desc2_ja\` TEXT NOT NULL,
        \`quote_en\` TEXT NOT NULL,
        \`quote_ja\` TEXT NOT NULL,
        \`created_at\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        \`updated_at\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    `);

    await conn.query(`
      CREATE TABLE IF NOT EXISTS \`services\` (
        \`id\` INT AUTO_INCREMENT PRIMARY KEY,
        \`number_label\` VARCHAR(20) NOT NULL DEFAULT '01',
        \`title_en\` VARCHAR(255) NOT NULL,
        \`title_ja\` VARCHAR(255) NOT NULL,
        \`desc_en\` TEXT NOT NULL,
        \`desc_ja\` TEXT NOT NULL,
        \`items_en\` JSON NOT NULL,
        \`items_ja\` JSON NOT NULL,
        \`sort_order\` INT NOT NULL DEFAULT 0,
        \`created_at\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        \`updated_at\` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    `);

    // 3. Auto-seed if empty
    const [companyRows] = await conn.query('SELECT COUNT(*) as count FROM company_info');
    if (companyRows[0].count === 0) {
      await conn.query(`
        INSERT INTO company_info (
          id, name_en, name_ja, tagline_en, tagline_ja,
          location_en, location_ja, phone, business_en, business_ja,
          license, ceo_name, ceo_role_en, ceo_role_ja,
          hero_title_en, hero_title_accent_en, hero_desc_en,
          hero_title_ja, hero_title_accent_ja, hero_desc_ja,
          hero_image, footer_text_en, footer_text_ja
        ) VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      `, [
        DEFAULT_COMPANY_INFO.name_en,
        DEFAULT_COMPANY_INFO.name_ja,
        DEFAULT_COMPANY_INFO.tagline_en,
        DEFAULT_COMPANY_INFO.tagline_ja,
        DEFAULT_COMPANY_INFO.location_en,
        DEFAULT_COMPANY_INFO.location_ja,
        DEFAULT_COMPANY_INFO.phone,
        DEFAULT_COMPANY_INFO.business_en,
        DEFAULT_COMPANY_INFO.business_ja,
        DEFAULT_COMPANY_INFO.license,
        DEFAULT_COMPANY_INFO.ceo_name,
        DEFAULT_COMPANY_INFO.ceo_role_en,
        DEFAULT_COMPANY_INFO.ceo_role_ja,
        DEFAULT_COMPANY_INFO.hero_title_en,
        DEFAULT_COMPANY_INFO.hero_title_accent_en,
        DEFAULT_COMPANY_INFO.hero_desc_en,
        DEFAULT_COMPANY_INFO.hero_title_ja,
        DEFAULT_COMPANY_INFO.hero_title_accent_ja,
        DEFAULT_COMPANY_INFO.hero_desc_ja,
        DEFAULT_COMPANY_INFO.hero_image,
        DEFAULT_COMPANY_INFO.footer_text_en,
        DEFAULT_COMPANY_INFO.footer_text_ja
      ]);
    }

    const [aboutRows] = await conn.query('SELECT COUNT(*) as count FROM abouts');
    if (aboutRows[0].count === 0) {
      await conn.query(`
        INSERT INTO abouts (
          id, badge_en, badge_ja, heading_en, heading_ja,
          subheading_en, subheading_ja, title_en, title_ja,
          desc1_en, desc1_ja, desc2_en, desc2_ja, quote_en, quote_ja
        ) VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      `, [
        DEFAULT_ABOUT.badge_en,
        DEFAULT_ABOUT.badge_ja,
        DEFAULT_ABOUT.heading_en,
        DEFAULT_ABOUT.heading_ja,
        DEFAULT_ABOUT.subheading_en,
        DEFAULT_ABOUT.subheading_ja,
        DEFAULT_ABOUT.title_en,
        DEFAULT_ABOUT.title_ja,
        DEFAULT_ABOUT.desc1_en,
        DEFAULT_ABOUT.desc1_ja,
        DEFAULT_ABOUT.desc2_en,
        DEFAULT_ABOUT.desc2_ja,
        DEFAULT_ABOUT.quote_en,
        DEFAULT_ABOUT.quote_ja
      ]);
    }

    const [serviceRows] = await conn.query('SELECT COUNT(*) as count FROM services');
    if (serviceRows[0].count === 0) {
      for (const s of DEFAULT_SERVICES) {
        await conn.query(`
          INSERT INTO services (
            id, number_label, title_en, title_ja, desc_en, desc_ja, items_en, items_ja, sort_order
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        `, [
          s.id,
          s.number_label,
          s.title_en,
          s.title_ja,
          s.desc_en,
          s.desc_ja,
          JSON.stringify(s.items_en),
          JSON.stringify(s.items_ja),
          s.sort_order
        ]);
      }
    }

    conn.release();
    isConnected = true;
    console.log(`[MySQL] Successfully connected to MySQL database "${DB_CONFIG.database}" on ${DB_CONFIG.host}:${DB_CONFIG.port}`);
    return true;
  } catch (err) {
    isConnected = false;
    console.warn(`[MySQL] Notice: Could not connect to MySQL server at ${DB_CONFIG.host}:${DB_CONFIG.port} (${err.code || err.message}).`);
    console.info(`[MySQL] Running with dynamic data layer (fallback storage enabled). Whenever MySQL is online, it will automatically connect.`);
    return false;
  }
}

export async function getCompanyInfo() {
  if (isConnected) {
    try {
      const [rows] = await getPool().query('SELECT * FROM company_info ORDER BY id ASC LIMIT 1');
      if (rows && rows.length > 0) return rows[0];
    } catch (err) {
      console.error('[MySQL Error] getCompanyInfo query failed:', err.message);
    }
  }
  return fallbackCompanyInfo;
}

export async function getAboutSection() {
  if (isConnected) {
    try {
      const [rows] = await getPool().query('SELECT * FROM abouts ORDER BY id ASC LIMIT 1');
      if (rows && rows.length > 0) return rows[0];
    } catch (err) {
      console.error('[MySQL Error] getAboutSection query failed:', err.message);
    }
  }
  return fallbackAbout;
}

export async function getServices() {
  if (isConnected) {
    try {
      const [rows] = await getPool().query('SELECT * FROM services ORDER BY sort_order ASC, id ASC');
      if (rows && rows.length > 0) {
        return rows.map(r => ({
          ...r,
          items_en: typeof r.items_en === 'string' ? JSON.parse(r.items_en) : (r.items_en || []),
          items_ja: typeof r.items_ja === 'string' ? JSON.parse(r.items_ja) : (r.items_ja || [])
        }));
      }
    } catch (err) {
      console.error('[MySQL Error] getServices query failed:', err.message);
    }
  }
  return fallbackServices;
}

export async function getAllData() {
  const [company, about, services] = await Promise.all([
    getCompanyInfo(),
    getAboutSection(),
    getServices()
  ]);

  return {
    company,
    about,
    services,
    dbStatus: {
      connected: isConnected,
      host: DB_CONFIG.host,
      port: DB_CONFIG.port,
      database: DB_CONFIG.database,
      user: DB_CONFIG.user
    }
  };
}

export async function updateCompanyInfo(data) {
  if (isConnected) {
    try {
      await getPool().query(`
        UPDATE company_info SET
          name_en = ?, name_ja = ?, tagline_en = ?, tagline_ja = ?,
          location_en = ?, location_ja = ?, phone = ?, business_en = ?, business_ja = ?,
          license = ?, ceo_name = ?, ceo_role_en = ?, ceo_role_ja = ?,
          hero_title_en = ?, hero_title_accent_en = ?, hero_desc_en = ?,
          hero_title_ja = ?, hero_title_accent_ja = ?, hero_desc_ja = ?,
          hero_image = ?, footer_text_en = ?, footer_text_ja = ?
        WHERE id = 1
      `, [
        data.name_en, data.name_ja, data.tagline_en, data.tagline_ja,
        data.location_en, data.location_ja, data.phone, data.business_en, data.business_ja,
        data.license, data.ceo_name, data.ceo_role_en, data.ceo_role_ja,
        data.hero_title_en, data.hero_title_accent_en, data.hero_desc_en,
        data.hero_title_ja, data.hero_title_accent_ja, data.hero_desc_ja,
        data.hero_image, data.footer_text_en, data.footer_text_ja
      ]);
    } catch (err) {
      console.error('[MySQL Error] updateCompanyInfo failed:', err.message);
    }
  }
  fallbackCompanyInfo = { ...fallbackCompanyInfo, ...data };
  return fallbackCompanyInfo;
}

export async function updateAboutSection(data) {
  if (isConnected) {
    try {
      await getPool().query(`
        UPDATE abouts SET
          badge_en = ?, badge_ja = ?, heading_en = ?, heading_ja = ?,
          subheading_en = ?, subheading_ja = ?, title_en = ?, title_ja = ?,
          desc1_en = ?, desc1_ja = ?, desc2_en = ?, desc2_ja = ?,
          quote_en = ?, quote_ja = ?
        WHERE id = 1
      `, [
        data.badge_en, data.badge_ja, data.heading_en, data.heading_ja,
        data.subheading_en, data.subheading_ja, data.title_en, data.title_ja,
        data.desc1_en, data.desc1_ja, data.desc2_en, data.desc2_ja,
        data.quote_en, data.quote_ja
      ]);
    } catch (err) {
      console.error('[MySQL Error] updateAboutSection failed:', err.message);
    }
  }
  fallbackAbout = { ...fallbackAbout, ...data };
  return fallbackAbout;
}

export async function updateService(id, data) {
  const itemsEn = Array.isArray(data.items_en) ? data.items_en : [];
  const itemsJa = Array.isArray(data.items_ja) ? data.items_ja : [];
  
  if (isConnected) {
    try {
      await getPool().query(`
        UPDATE services SET
          number_label = ?, title_en = ?, title_ja = ?,
          desc_en = ?, desc_ja = ?, items_en = ?, items_ja = ?, sort_order = ?
        WHERE id = ?
      `, [
        data.number_label, data.title_en, data.title_ja,
        data.desc_en, data.desc_ja, JSON.stringify(itemsEn), JSON.stringify(itemsJa),
        data.sort_order || 0, id
      ]);
    } catch (err) {
      console.error('[MySQL Error] updateService failed:', err.message);
    }
  }
  
  const index = fallbackServices.findIndex(s => s.id === parseInt(id, 10));
  if (index !== -1) {
    fallbackServices[index] = { ...fallbackServices[index], ...data, items_en: itemsEn, items_ja: itemsJa };
  }
  return fallbackServices;
}

export async function addService(data) {
  const itemsEn = Array.isArray(data.items_en) ? data.items_en : [];
  const itemsJa = Array.isArray(data.items_ja) ? data.items_ja : [];
  let newId = Date.now();

  if (isConnected) {
    try {
      const [res] = await getPool().query(`
        INSERT INTO services (
          number_label, title_en, title_ja, desc_en, desc_ja, items_en, items_ja, sort_order
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
      `, [
        data.number_label || '03',
        data.title_en,
        data.title_ja,
        data.desc_en,
        data.desc_ja,
        JSON.stringify(itemsEn),
        JSON.stringify(itemsJa),
        data.sort_order || fallbackServices.length + 1
      ]);
      newId = res.insertId;
    } catch (err) {
      console.error('[MySQL Error] addService failed:', err.message);
    }
  }

  const newService = {
    id: newId,
    number_label: data.number_label || `0${fallbackServices.length + 1}`,
    title_en: data.title_en,
    title_ja: data.title_ja,
    desc_en: data.desc_en,
    desc_ja: data.desc_ja,
    items_en: itemsEn,
    items_ja: itemsJa,
    sort_order: data.sort_order || fallbackServices.length + 1
  };
  fallbackServices.push(newService);
  return newService;
}

export async function deleteService(id) {
  const numId = parseInt(id, 10);
  if (isConnected) {
    try {
      await getPool().query('DELETE FROM services WHERE id = ?', [numId]);
    } catch (err) {
      console.error('[MySQL Error] deleteService failed:', err.message);
    }
  }
  fallbackServices = fallbackServices.filter(s => s.id !== numId);
  return true;
}

export async function getServiceById(id) {
  const numId = parseInt(id, 10);
  if (isConnected) {
    try {
      const [rows] = await getPool().query('SELECT * FROM services WHERE id = ? LIMIT 1', [numId]);
      if (rows && rows.length > 0) {
        const r = rows[0];
        return {
          ...r,
          items_en: typeof r.items_en === 'string' ? JSON.parse(r.items_en) : (r.items_en || []),
          items_ja: typeof r.items_ja === 'string' ? JSON.parse(r.items_ja) : (r.items_ja || [])
        };
      }
    } catch (err) {
      console.error('[MySQL Error] getServiceById failed:', err.message);
    }
  }
  return fallbackServices.find(s => s.id === numId) || null;
}

