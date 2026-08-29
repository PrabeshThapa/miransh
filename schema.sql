-- MIRANSH MySQL Database Schema & Initial Data
CREATE DATABASE IF NOT EXISTS `miransh` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `miransh`;

-- 1. Company Information Table
DROP TABLE IF EXISTS `company_info`;
CREATE TABLE `company_info` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name_en` VARCHAR(255) NOT NULL DEFAULT 'MIRANSH LLC',
  `name_ja` VARCHAR(255) NOT NULL DEFAULT 'ミランス合同会社',
  `tagline_en` VARCHAR(255) NOT NULL DEFAULT 'International Human Resources & Student Support',
  `tagline_ja` VARCHAR(255) NOT NULL DEFAULT '国際人材紹介・留学生紹介',
  `location_en` VARCHAR(255) NOT NULL DEFAULT 'Koganei-shi, Tokyo, Japan',
  `location_ja` VARCHAR(255) NOT NULL DEFAULT '東京都小金井市',
  `phone` VARCHAR(50) NOT NULL DEFAULT '042-409-8256',
  `business_en` TEXT NOT NULL,
  `business_ja` TEXT NOT NULL,
  `license` VARCHAR(100) NOT NULL DEFAULT '13-ユ-319558',
  `ceo_name` VARCHAR(100) NOT NULL DEFAULT 'RK Giri',
  `ceo_role_en` VARCHAR(255) NOT NULL DEFAULT 'CEO / Representative of MIRANSH LLC',
  `ceo_role_ja` VARCHAR(255) NOT NULL DEFAULT 'ミランス合同会社 代表者',
  `hero_title_en` VARCHAR(255) NOT NULL DEFAULT 'Connecting Japan',
  `hero_title_accent_en` VARCHAR(255) NOT NULL DEFAULT 'Global Talent',
  `hero_desc_en` TEXT NOT NULL,
  `hero_title_ja` VARCHAR(255) NOT NULL DEFAULT '日本と世界を',
  `hero_title_accent_ja` VARCHAR(255) NOT NULL DEFAULT 'つなぐ会社',
  `hero_desc_ja` TEXT NOT NULL,
  `hero_image` VARCHAR(255) NOT NULL DEFAULT '/images/abc.jpeg',
  `footer_text_en` TEXT NOT NULL,
  `footer_text_ja` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. About Section Table
DROP TABLE IF EXISTS `abouts`;
CREATE TABLE `abouts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `badge_en` VARCHAR(100) NOT NULL DEFAULT 'About MIRANSH',
  `badge_ja` VARCHAR(100) NOT NULL DEFAULT 'MIRANSHについて',
  `heading_en` VARCHAR(255) NOT NULL DEFAULT 'Building Bridges Between Japan and the World',
  `heading_ja` VARCHAR(255) NOT NULL DEFAULT '日本と世界をつなぐ架け橋',
  `subheading_en` TEXT NOT NULL,
  `subheading_ja` TEXT NOT NULL,
  `title_en` VARCHAR(255) NOT NULL DEFAULT 'MIRANSH LLC',
  `title_ja` VARCHAR(255) NOT NULL DEFAULT 'ミランス合同会社',
  `desc1_en` TEXT NOT NULL,
  `desc1_ja` TEXT NOT NULL,
  `desc2_en` TEXT NOT NULL,
  `desc2_ja` TEXT NOT NULL,
  `quote_en` TEXT NOT NULL,
  `quote_ja` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Services Table
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `number_label` VARCHAR(20) NOT NULL DEFAULT '01',
  `title_en` VARCHAR(255) NOT NULL,
  `title_ja` VARCHAR(255) NOT NULL,
  `desc_en` TEXT NOT NULL,
  `desc_ja` TEXT NOT NULL,
  `items_en` JSON NOT NULL,
  `items_ja` JSON NOT NULL,
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Initial Data

INSERT INTO `company_info` (
  `id`, `name_en`, `name_ja`, `tagline_en`, `tagline_ja`,
  `location_en`, `location_ja`, `phone`,
  `business_en`, `business_ja`, `license`,
  `ceo_name`, `ceo_role_en`, `ceo_role_ja`,
  `hero_title_en`, `hero_title_accent_en`, `hero_desc_en`,
  `hero_title_ja`, `hero_title_accent_ja`, `hero_desc_ja`,
  `hero_image`, `footer_text_en`, `footer_text_ja`
) VALUES (
  1,
  'MIRANSH LLC',
  'ミランス合同会社',
  'International Human Resources & Student Support',
  '国際人材紹介・留学生紹介',
  'Koganei-shi, Tokyo, Japan',
  '東京都小金井市',
  '042-409-8256',
  'Foreign Worker Recruitment, Visa Support, Life Support, International Student Support',
  '外国人材紹介、ビザサポート、ライフサポート、留学生紹介',
  '13-ユ-319558',
  'RK Giri',
  'CEO / Representative of MIRANSH LLC',
  'ミランス合同会社 代表者',
  'Connecting Japan',
  'Global Talent',
  'We at MIRANSH LLC aim to be a bridge between Japan and the international community, contributing to the creation of a beautiful society where all people can help one another and live happily.',
  '日本と世界を',
  'つなぐ会社',
  'ミランス合同会社は、日本と国際社会をつなぐ架け橋となり、すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。',
  '/images/abc.jpeg',
  'International Human Resources & Student Support. Connecting Japan with international talent and students.',
  '国際人材紹介・留学生紹介。日本と世界の人材・留学生をつなぎます。'
);

INSERT INTO `abouts` (
  `id`, `badge_en`, `badge_ja`, `heading_en`, `heading_ja`,
  `subheading_en`, `subheading_ja`, `title_en`, `title_ja`,
  `desc1_en`, `desc1_ja`, `desc2_en`, `desc2_ja`,
  `quote_en`, `quote_ja`
) VALUES (
  1,
  'About MIRANSH',
  'MIRANSHについて',
  'Building Bridges Between Japan and the World',
  '日本と世界をつなぐ架け橋',
  'Supporting people who want to work, study and build their future in Japan.',
  '日本で働きたい、学びたい、将来を築きたい外国人の皆様をサポートします。',
  'MIRANSH LLC',
  'ミランス合同会社',
  'We partner with educational institutions abroad to support foreigners, primarily from Nepal, who have passed the Japanese Language Proficiency Test and/or specific skills tests, or hold a university degree, in their search for employment or study in Japan.',
  '海外の教育機関と連携し、主にネパールをはじめとする外国人の方々を対象に、日本語能力試験（JLPT）や特定技能試験に合格された方、または大学を卒業された方の日本での就職・就学をサポートしています。',
  'We provide support with visa applications, preparations for coming to Japan, and daily life and living support after arriving in Japan.',
  'ビザ申請、日本へ来日するための準備、そして日本での生活・暮らしに関するライフサポートも行っています。',
  '\"We aim to contribute to a beautiful society where all people can help one another and live happily.\"',
  '「すべての人々がお互いに助け合い、幸せに暮らせる美しい社会の実現に貢献することを目指しています。」'
);

INSERT INTO `services` (`id`, `number_label`, `title_en`, `title_ja`, `desc_en`, `desc_ja`, `items_en`, `items_ja`, `sort_order`) VALUES
(
  1,
  '01',
  'Foreign Worker Recruitment',
  '国際人材紹介',
  'We help Nepali and other foreign nationals find employment with Japanese companies.',
  '日本語能力試験（JLPT）合格者、特定技能（Tokutei Ginou）合格者、または大学卒業者など、ネパールをはじめとする外国人の方々の日本企業への就職をサポートします。',
  '["JLPT-qualified candidates", "Specified Skilled Worker (Tokutei Ginou) candidates", "University graduates", "Employment opportunities with Japanese companies", "Visa application support", "Preparation for coming to Japan", "Life and daily living support in Japan"]',
  '["JLPT合格者", "特定技能（Tokutei Ginou）合格者", "大学卒業者", "日本企業への就職支援", "ビザ申請サポート", "来日前の準備サポート", "日本での生活・ライフサポート"]',
  1
),
(
  2,
  '02',
  'International Student Support',
  '留学生紹介',
  'We support foreign students who wish to come to Japan for education by helping them with admission to Japanese educational institutions.',
  'ネパールおよびその他の国の教育機関と連携し、日本で学びたい外国人留学生の皆様の進学・入学をサポートします。',
  '["Partnerships with educational institutions in Nepal and other countries", "Japanese Language School admission support", "College admission support", "Study-in-Japan consultation", "Admission preparation support"]',
  '["ネパール・海外の教育機関との提携", "日本語学校への入学支援", "専門学校・大学等への進学支援", "日本留学に関する相談", "入学準備サポート"]',
  2
);
