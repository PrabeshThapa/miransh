// database/seed_vacancies.js
import Database from 'better-sqlite3';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const dbPaths = [
  path.join(__dirname, 'database.sqlite'),
  path.join(__dirname, '..', 'database.sqlite')
];

for (const dbPath of dbPaths) {
  try {
    const db = new Database(dbPath);
    console.log(`Seeding vacancies into: ${dbPath}`);

    // Ensure tables exist
    db.exec(`
      CREATE TABLE IF NOT EXISTS job_vacancies (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        job_code VARCHAR(50) UNIQUE NOT NULL,
        title_ja VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NOT NULL,
        employment_type VARCHAR(50) DEFAULT 'full_time',
        location_ja VARCHAR(255) NOT NULL,
        location_en VARCHAR(255) NOT NULL,
        salary_min INTEGER,
        salary_max INTEGER,
        salary_type VARCHAR(20) DEFAULT 'monthly',
        salary_note_ja TEXT,
        salary_note_en TEXT,
        working_hours_ja TEXT,
        working_hours_en TEXT,
        holidays_ja TEXT,
        holidays_en TEXT,
        description_ja TEXT NOT NULL,
        description_en TEXT NOT NULL,
        status VARCHAR(20) DEFAULT 'draft',
        sort_order INTEGER DEFAULT 0,
        published_at DATETIME,
        closed_at DATETIME,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
      );

      CREATE TABLE IF NOT EXISTS job_responsibilities (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        job_vacancy_id INTEGER NOT NULL REFERENCES job_vacancies(id) ON DELETE CASCADE,
        title_ja VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NOT NULL,
        description_ja TEXT,
        description_en TEXT,
        sort_order INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
      );

      CREATE TABLE IF NOT EXISTS job_requirements (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        job_vacancy_id INTEGER NOT NULL REFERENCES job_vacancies(id) ON DELETE CASCADE,
        type VARCHAR(20) DEFAULT 'required',
        description_ja TEXT NOT NULL,
        description_en TEXT NOT NULL,
        sort_order INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
      );

      CREATE TABLE IF NOT EXISTS job_benefits (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        job_vacancy_id INTEGER NOT NULL REFERENCES job_vacancies(id) ON DELETE CASCADE,
        title_ja VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NOT NULL,
        description_ja TEXT,
        description_en TEXT,
        sort_order INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
      );
    `);

    // Define the Vacancies Data
    const vacancies = [
      {
        job_code: 'MIR-2026-001',
        title_ja: '総合職（海外人材コーディネーター 兼 一般事務・経理補助）',
        title_en: 'Global Talent Coordinator, General Affairs & Accounting Assistant',
        employment_type: 'full_time',
        location_ja: '東京都小金井市（JR中央線 東小金井駅・武蔵小金井駅 / 西武多摩川線 新小金井駅）',
        location_en: 'Tokyo (Koganei-shi, near Higashi-Koganei / Shin-Koganei Station)',
        salary_min: 220000,
        salary_max: 250000,
        salary_type: 'monthly',
        salary_note_ja: '月給 220,000円 〜 250,000円（経験・能力・保有スキルに応ず / Experience・Skills अनुसार。昇給年1回、賞与年2回、残業代別途支給）',
        salary_note_en: 'Monthly Salary: ¥220,000 – ¥250,000 (Based on Experience/Skills अनुसार. Annual salary review, bi-annual bonuses, overtime paid)',
        working_hours_ja: '9:00 〜 18:00（実働8時間、休憩60分）',
        working_hours_en: '9:00 – 18:00 (8 hours work, 60 minutes break)',
        holidays_ja: '完全週休2日制（土日）、祝日、年末年始休暇、夏季休暇、年次有給休暇',
        holidays_en: 'Five-day work week (Saturdays, Sundays off), National holidays, Year-end & New Year holidays, Summer leave, Annual paid leave',
        description_ja: 'MIRANSH合同会社では、自社オフィスにて海外人材紹介および特定技能支援事業を推進する総合職（正社員）を募集しています。専門学校等で修得したIT・ビジネス情報スキル（高度なExcel処理、Word文書作成、商業簿記の基礎）を活かし、海外人材のデータベース管理から入管書類作成、バックオフィス業務まで多岐にわたる活躍を期待しています。',
        description_en: 'MIRANSH LLC is seeking a dedicated, full-time Global Talent Coordinator and Administrative Assistant to join our Tokyo headquarters. Candidates will leverage advanced Excel database processing, Word business documentation, and commercial bookkeeping fundamentals acquired during vocational college to coordinate overseas recruitment, visa paperwork, and administrative operations.',
        status: 'published',
        sort_order: 1,
        published_at: '2026-09-19 12:00:00',
        responsibilities: [
          {
            title_ja: '海外人材の募集・マッチング管理',
            title_en: 'Recruitment & Database Management',
            description_ja: 'ネパール等の提携機関との連携、求職者データの管理（専門学校で習得した Excel 高度スキル を活用）。',
            description_en: 'Liaison with partner institutions in Nepal, candidate data management (utilizing advanced Excel skills acquired at vocational college).',
            sort_order: 1
          },
          {
            title_ja: '通訳・翻訳および書類作成',
            title_en: 'Translation & Document Preparation',
            description_ja: '求人票や講習テキストの翻訳（ネパール語・日本語）。在留資格申請に必要な提出書類の作成（Word/文書処理能力 を活用）。',
            description_en: 'Translation of job postings and training manuals (Nepali/Japanese). Preparation of application documents for Status of Residence (utilizing Word/document processing skills).',
            sort_order: 2
          },
          {
            title_ja: '経理・営業事務補助',
            title_en: 'Accounting & Administrative Support',
            description_ja: '提携先企業への請求書作成、売上データの入力および伝票整理（商業簿記知識 を活用）。',
            description_en: 'Invoicing for partner companies, recording sales data, and organizing slips/vouchers (utilizing commercial bookkeeping knowledge).',
            sort_order: 3
          },
          {
            title_ja: 'オリエンテーションおよび生活支援',
            title_en: 'Orientation & Candidate Support',
            description_ja: '来日した人材に対するビジネスマナー指導および生活サポート。',
            description_en: 'Business etiquette instruction and daily living integration support for international personnel arriving in Japan.',
            sort_order: 4
          }
        ],
        requirements: [
          {
            type: 'required',
            description_ja: '専門学校（経営経済・ビジネス情報系課程）修了者',
            description_en: 'Graduates of vocational college (Business Administration, Economics, or Business Information Systems courses)',
            sort_order: 1
          },
          {
            type: 'required',
            description_ja: 'PCスキル必須（Excel/Word の実務応用が可能な方）',
            description_en: 'PC skills required (practical application proficiency in Microsoft Excel and Word)',
            sort_order: 2
          },
          {
            type: 'required',
            description_ja: '日本語能力試験 N3 以上（円滑なビジネスコミュニケーション）',
            description_en: 'Japanese Language Proficiency Test (JLPT) N3 or higher (practical business communication)',
            sort_order: 3
          },
          {
            type: 'preferred',
            description_ja: '日本語能力試験 N2 以上、または BJTビジネス日本語能力テスト 400点以上歓迎',
            description_en: 'JLPT N2 or higher, or Business Japanese Proficiency Test (BJT) 400+ points welcome',
            sort_order: 4
          },
          {
            type: 'preferred',
            description_ja: '商業簿記・会計知識の基礎（日商簿記3級程度または専門学校での簿記履修）',
            description_en: 'Basic commercial bookkeeping knowledge (Nissho Bookkeeping Level 3 or coursework at vocational college)',
            sort_order: 5
          },
          {
            type: 'preferred',
            description_ja: 'ネパール語または英語での日常会話・ビジネス文書作成スキル',
            description_en: 'Language skills in Nepali or English for candidate communication and translation',
            sort_order: 6
          }
        ],
        benefits: [
          {
            title_ja: '各種社会保険完備',
            title_en: 'Comprehensive Social Insurance',
            description_ja: '健康保険、厚生年金保険、雇用保険、労働者災害補償保険（労災）',
            description_en: 'Health insurance, employee pension, employment insurance, worker accident compensation',
            sort_order: 1
          },
          {
            title_ja: '交通費全額支給',
            title_en: 'Commuter Allowance',
            description_ja: '通勤にかかる実費交通費を支給（社内規定による）',
            description_en: 'Full reimbursement of commuting transportation costs according to company policy',
            sort_order: 2
          },
          {
            title_ja: '昇給・賞与制度',
            title_en: 'Salary Review & Performance Bonuses',
            description_ja: '昇給年1回、業績連動賞与年2回支給',
            description_en: 'Annual base salary review, bi-annual performance-based bonuses',
            sort_order: 3
          },
          {
            title_ja: '在留資格（就労ビザ）更新・変更支援',
            title_en: 'Visa Renewal & Status Change Sponsorship',
            description_ja: '「技術・人文知識・国際業務」等の就労ビザ申請・更新手続きを会社が全面サポート',
            description_en: 'Full administrative support for Work Visa renewals ("Engineer/Specialist in Humanities/International Services")',
            sort_order: 4
          },
          {
            title_ja: '社用PC・通信端末貸与',
            title_en: 'Company Laptop & Mobile Device',
            description_ja: '最新の業務ノートPCおよび必要に応じた通信端末・周辺機器を貸与',
            description_en: 'Latest business laptop and mobile communication devices provided',
            sort_order: 5
          }
        ]
      },
      {
        job_code: 'MIR-2026-002',
        title_ja: '特定技能・外国人材生活支援コーディネーター（フィールドサポーター兼通訳）',
        title_en: 'Specified Skilled Worker Support Coordinator & Field Orientation Specialist',
        employment_type: 'full_time',
        location_ja: '東京都（本社：小金井市）および首都圏（東京・神奈川・埼玉・千葉）の提携先企業・受入施設',
        location_en: 'Tokyo HQ (Koganei-shi) & Partner Facilities across Greater Tokyo Area',
        salary_min: 230000,
        salary_max: 260000,
        salary_type: 'monthly',
        salary_note_ja: '月給 230,000円 〜 260,000円（経験・能力・保有資格に応ず / Experience・Skills अनुसार。外勤手当・残業代別途支給）',
        salary_note_en: 'Monthly Salary: ¥230,000 – ¥260,000 (Based on Experience/Skills अनुसार. Field allowances and overtime paid)',
        working_hours_ja: '9:00 〜 18:00（実働8時間、休憩60分 ※巡回スケジュールにより時差出勤あり）',
        working_hours_en: '9:00 – 18:00 (8 hours work, 60 min break; flex schedules available for field appointments)',
        holidays_ja: '週休2日制（土日祝 ※業務都合による振替あり）、年末年始休暇、夏季休暇、有給休暇',
        holidays_en: 'Five-day work week (Weekends & Holidays off with compensatory leave), New Year & Summer breaks, Paid leave',
        description_ja: 'MIRANSH合同会社の登録支援機関業務および特定技能サポート事業において、来日した外国人財（主にネパール等の介護・外食・食品製造・ビルクリーニング分野）が日本社会に安心して溶け込み、受入企業様で長く活躍できるよう伴走するフィールドコーディネーター（正社員）です。空港出迎えから行政手続き同行、現場での三者面談や通訳、生活相談まで、頼れる相談役として多文化共生を現場から推進します。',
        description_en: 'MIRANSH LLC is seeking an enthusiastic Field Orientation Specialist & Bilingual Interpreter to assist Specified Skilled Workers (SSW) across the Greater Tokyo Area. You will guide foreign professionals from airport arrival and municipal registrations to regular workplace visits, bilingual interpretation (Japanese-Nepali/English), and lifestyle counseling.',
        status: 'published',
        sort_order: 2,
        published_at: '2026-09-19 12:00:00',
        responsibilities: [
          {
            title_ja: '空港出迎え・生活立ち上げ同行支援',
            title_en: 'Airport Reception & Living Setup Support',
            description_ja: '来日時の空港お出迎え、市区町村役所での転入届・マイナンバー手続き、銀行口座開設、携帯電話契約、アパート入居の同行ガイダンス。',
            description_en: 'Airport pick-up, resident registration and My Number procedures at city halls, bank account setup, mobile phone contracts, and apartment move-in guidance.',
            sort_order: 1
          },
          {
            title_ja: '定期面談・職場巡回および通訳サポート',
            title_en: 'Workplace Visits & Interpretation',
            description_ja: '受入企業様（介護施設や工場等）への定期巡回・三者面談の実施、職場コミュニケーションの通訳、母国語による悩み相談・メンタルケア。',
            description_en: 'Regular check-ins and tripartite meetings at host companies, on-site interpretation, and empathetic lifestyle/mental well-being counseling in native language.',
            sort_order: 2
          },
          {
            title_ja: '日本語教育伴走および生活オリエンテーション',
            title_en: 'Language Coaching & Japanese Customs Orientation',
            description_ja: '日本のビジネスマナー、ゴミ出しルール、公共交通マナー、防災避難訓練の指導、およびJLPT資格取得や専門用語学習のサポート。',
            description_en: 'Instruction on Japanese workplace etiquette, neighborhood rules, disaster prevention protocols, and ongoing Japanese language coaching (JLPT / caregiving terms).',
            sort_order: 3
          },
          {
            title_ja: '支援実施状況報告書の作成・入管届出連携',
            title_en: 'Support Records & Immigration Compliance Reporting',
            description_ja: '出入国在留管理局に対する定期支援報告書および相談記録の作成・管理（Word/Excelを活用した適正なコンプライアンス管理）。',
            description_en: 'Drafting quarterly support logs and consultation reports for the Immigration Services Agency using Excel and Word in compliance with statutory standards.',
            sort_order: 4
          }
        ],
        requirements: [
          {
            type: 'required',
            description_ja: '専門学校（国際教養・語学・福祉・ビジネス系課程）修了者、または短大・大学卒業者',
            description_en: 'Graduates of vocational college (International Studies, Languages, Welfare, or Business) or Junior College / University degree',
            sort_order: 1
          },
          {
            type: 'required',
            description_ja: '日本語能力試験 N2 以上（またはN3で高いコミュニケーション・対話力をお持ちの方）',
            description_en: 'Japanese Language Proficiency Test (JLPT) N2 or higher (or N3 with strong interpersonal communication skills)',
            sort_order: 2
          },
          {
            type: 'required',
            description_ja: 'ネパール語ネイティブまたはバイリンガルレベル（母国語での円滑な面談・通訳が可能な方）',
            description_en: 'Native or fluent bilingual proficiency in Nepali (capable of seamless one-on-one counseling and interpretation)',
            sort_order: 3
          },
          {
            type: 'required',
            description_ja: 'PC基本スキル（Word、Excelによる報告書作成やビジネスメールの送受信）',
            description_en: 'Basic PC proficiency (drafting regular reports in Word/Excel, business email correspondence)',
            sort_order: 4
          },
          {
            type: 'preferred',
            description_ja: '普通自動車第一種運転免許（AT限定可、首都圏エリアの施設巡回・生活同行時に活用）',
            description_en: 'Japanese Standard Driver License (AT acceptable, useful for candidate transport and facility visits)',
            sort_order: 5
          },
          {
            type: 'preferred',
            description_ja: '登録支援機関、人材紹介会社、または介護施設等での勤務経験者歓迎',
            description_en: 'Experience working in registered support organizations, staffing agencies, or care facilities is highly welcomed',
            sort_order: 6
          }
        ],
        benefits: [
          {
            title_ja: '各種社会保険完備',
            title_en: 'Comprehensive Social Insurance',
            description_ja: '健康保険、厚生年金保険、雇用保険、労働者災害補償保険（労災）',
            description_en: 'Health insurance, employee pension, employment insurance, worker accident compensation',
            sort_order: 1
          },
          {
            title_ja: '交通費・移動経費全額支給',
            title_en: 'Full Travel & Field Expense Coverage',
            description_ja: '施設巡回や候補者同行に伴う交通費、出張旅費を全額実費精算',
            description_en: 'Full reimbursement for local transit, express trains, and travel expenses during field assignments',
            sort_order: 2
          },
          {
            title_ja: '昇給年1回・賞与年2回',
            title_en: 'Annual Raise & Bi-Annual Bonuses',
            description_ja: '個人の貢献度および業績に応じた昇給・賞与支給体制',
            description_en: 'Regular merit-based salary evaluation and performance bonuses twice a year',
            sort_order: 3
          },
          {
            title_ja: '就労ビザ（在留資格）更新手続き全額会社負担',
            title_en: 'Company-Paid Visa Renewal Support',
            description_ja: '就労ビザの更新申請にかかる書類準備・行政手数料を会社が負担・支援',
            description_en: 'Company-sponsored legal paperwork and administrative fee coverage for work visa renewals',
            sort_order: 4
          },
          {
            title_ja: '社用スマートフォン・ノートPC貸与',
            title_en: 'Smartphone & Work Laptop Provided',
            description_ja: '通訳・連絡用のスマートフォンおよび外出先でも作業できる軽量モバイルPCを支給',
            description_en: 'Dedicated business smartphone and portable laptop for mobile communication and field reporting',
            sort_order: 5
          }
        ]
      },
      {
        job_code: 'MIR-2026-003',
        title_ja: '海外人材採用コンサルタント 兼 クライアントリレーション担当（法人営業）',
        title_en: 'Global Talent Recruitment Consultant & Corporate Relations Representative',
        employment_type: 'full_time',
        location_ja: '東京都小金井市（本社オフィス / 都内および近郊クライアント企業への訪問）',
        location_en: 'Tokyo (Koganei HQ with client visits across the Kanto region)',
        salary_min: 240000,
        salary_max: 280000,
        salary_type: 'monthly',
        salary_note_ja: '月給 240,000円 〜 280,000円（経験・営業実績・保有スキルに応ず / Experience・Skills अनुसार。インセンティブ制度あり、昇給年1回、賞与年2回）',
        salary_note_en: 'Monthly Salary: ¥240,000 – ¥280,000 (Based on Experience/Skills अनुसार. Performance incentives, annual review, bi-annual bonuses)',
        working_hours_ja: '9:00 〜 18:00（実働8時間、休憩60分）',
        working_hours_en: '9:00 – 18:00 (8 hours work, 60 minutes break)',
        holidays_ja: '完全週休2日制（土日）、祝日、年末年始休暇、夏季休暇、慶弔休暇、有給休暇',
        holidays_en: 'Five-day work week (Saturdays, Sundays off), Public holidays, Year-end & Summer vacation, Paid leave',
        description_ja: '人手不足に直面する日本の優良企業様（介護医療グループ、飲食チェーン、食品加工、ホテル観光、物流など）に対し、ネパールをはじめとする意欲的な外国人財の活用提案を行う採用コンサルタント（正社員）です。企業ニーズのヒアリングから求人票の設計、現地送り出し機関とのマッチング、オンライン面接のセッティング、内定承諾までのプロセスを一貫して伴走します。',
        description_en: 'MIRANSH LLC is looking for an energetic Corporate Relations Consultant to expand partnerships with Japanese employers experiencing workforce shortages. You will consult with enterprise clients, design tailored job profiles, source qualified candidates through our Nepal education network, and coordinate interview cycles to job placement.',
        status: 'published',
        sort_order: 3,
        published_at: '2026-09-19 12:00:00',
        responsibilities: [
          {
            title_ja: '国内受入企業様へのヒアリング・求人票作成',
            title_en: 'Client Consultation & Job Profiling',
            description_ja: '企業様が抱える人材ニーズや配属現場の課題をヒアリングし、特定技能や就労ビザ制度に合致した最適な求人票を作成・提案。',
            description_en: 'Assessing staffing requirements and workplace cultures with client employers, crafting targeted job specifications aligned with immigration standards.',
            sort_order: 1
          },
          {
            title_ja: 'ネパール現地提携機関との連携・候補者マッチング',
            title_en: 'Overseas Sourcing Coordination & Screening',
            description_ja: 'ネパール現地の認定訓練校や提携アカデミーとオンラインで連携し、要件に合致する候補者スクリーニングおよび推薦手続きを主導。',
            description_en: 'Collaborating with accredited vocational academies in Nepal to screen qualified candidates and build a curated talent pipeline.',
            sort_order: 2
          },
          {
            title_ja: 'オンライン面接の設定・進行サポート',
            title_en: 'Web Interview Facilitation & Coordination',
            description_ja: '企業様と海外候補者間のWEB面接日程を調整し、事前の面接ガイダンスおよび当日の通訳・進行ファシリテーションを担当。',
            description_en: 'Arranging online video interviews between Japanese executives and overseas candidates, providing pre-interview briefings and bilingual facilitation.',
            sort_order: 3
          },
          {
            title_ja: '契約管理および入社までの進捗管理',
            title_en: 'Placement Follow-up & Onboarding Coordination',
            description_ja: '内定通知書・雇用契約書の締結支援、在留資格申請チームとの連携、入社日までの候補者モチベーション維持・フォロー。',
            description_en: 'Facilitating employment contracts, liaising with the visa documentation team, and maintaining candidate engagement up to official onboarding.',
            sort_order: 4
          }
        ],
        requirements: [
          {
            type: 'required',
            description_ja: '専門学校（経営、営業、ビジネス情報、マーケティング等）修了者または短大・大学卒',
            description_en: 'Graduates of vocational college (Business, Sales, Information, Marketing) or Junior College / University degree',
            sort_order: 1
          },
          {
            type: 'required',
            description_ja: '日本語能力試験 N2 以上（ビジネスレベルの敬語・商談対応力）',
            description_en: 'Japanese Language Proficiency Test (JLPT) N2 or higher (business negotiation fluency)',
            sort_order: 2
          },
          {
            type: 'required',
            description_ja: 'PCスキル（Excel, Word, PowerPoint / Googleスプレッドシート等を業務で活用できる方）',
            description_en: 'Proficiency in MS Office (Excel, Word, PowerPoint) and Google Workspace',
            sort_order: 3
          },
          {
            type: 'preferred',
            description_ja: 'ネパール語・英語でのコミュニケーション能力（海外提携校や候補者との円滑な対話）',
            description_en: 'Bilingual proficiency in Nepali or English for liaising with overseas institutions and candidates',
            sort_order: 4
          },
          {
            type: 'preferred',
            description_ja: '人材業界、法人営業、またはカスタマーサクセス・企画営業の実務経験',
            description_en: 'Prior experience in HR staffing, corporate sales, or client relationship management is preferred',
            sort_order: 5
          }
        ],
        benefits: [
          {
            title_ja: '各種社会保険完備',
            title_en: 'Comprehensive Social Insurance',
            description_ja: '健康保険、厚生年金保険、雇用保険、労働者災害補償保険（労災）',
            description_en: 'Health insurance, employee pension, employment insurance, worker accident compensation',
            sort_order: 1
          },
          {
            title_ja: '交通費全額支給＋営業活動費支給',
            title_en: 'Full Transit Reimbursement & Business Expenses',
            description_ja: '通勤交通費およびクライアント訪問に伴う交通費・通信費を全額支給',
            description_en: 'Full coverage for commuting transit, client visits, and business communication expenses',
            sort_order: 2
          },
          {
            title_ja: '昇給年1回・業績インセンティブ・賞与年2回',
            title_en: 'Salary Review, Commissions & Bi-Annual Bonuses',
            description_ja: '成果に応じたインセンティブ支給制度、定期昇給および賞与年2回',
            description_en: 'Attractive performance-linked commissions, annual salary evaluation, and bi-annual bonuses',
            sort_order: 3
          },
          {
            title_ja: '就労ビザ更新手続き・費用サポート',
            title_en: 'Full Visa Sponsorship & Renewal Support',
            description_ja: '就労ビザ（技術・人文知識・国際業務）の更新・変更手続きを会社が全面支援',
            description_en: 'Complete company legal sponsorship and administrative backing for work visa extensions',
            sort_order: 4
          },
          {
            title_ja: '社用ノートPC・モバイル環境完備',
            title_en: 'Company Laptop & Mobile Workstation',
            description_ja: '高性能ノートPC、モバイルWi-Fi、ビジネスチャット環境を提供',
            description_en: 'High-performance laptop, mobile connectivity, and collaborative SaaS suite provided',
            sort_order: 5
          }
        ]
      }
    ];

    const insertOrUpdateVacancy = db.transaction((v) => {
      // Check if vacancy exists by job_code
      const existing = db.prepare('SELECT id FROM job_vacancies WHERE job_code = ?').get(v.job_code);
      let vacancyId;

      if (existing) {
        vacancyId = existing.id;
        db.prepare(`
          UPDATE job_vacancies SET
            title_ja = ?, title_en = ?, employment_type = ?,
            location_ja = ?, location_en = ?, salary_min = ?, salary_max = ?,
            salary_type = ?, salary_note_ja = ?, salary_note_en = ?,
            working_hours_ja = ?, working_hours_en = ?, holidays_ja = ?, holidays_en = ?,
            description_ja = ?, description_en = ?, status = ?, sort_order = ?,
            published_at = ?, updated_at = CURRENT_TIMESTAMP
          WHERE id = ?
        `).run(
          v.title_ja, v.title_en, v.employment_type,
          v.location_ja, v.location_en, v.salary_min, v.salary_max,
          v.salary_type, v.salary_note_ja, v.salary_note_en,
          v.working_hours_ja, v.working_hours_en, v.holidays_ja, v.holidays_en,
          v.description_ja, v.description_en, v.status, v.sort_order,
          v.published_at, vacancyId
        );
        console.log(`Updated vacancy ${v.job_code} (ID: ${vacancyId})`);
      } else {
        const res = db.prepare(`
          INSERT INTO job_vacancies (
            job_code, title_ja, title_en, employment_type,
            location_ja, location_en, salary_min, salary_max,
            salary_type, salary_note_ja, salary_note_en,
            working_hours_ja, working_hours_en, holidays_ja, holidays_en,
            description_ja, description_en, status, sort_order,
            published_at, created_at, updated_at
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
        `).run(
          v.job_code, v.title_ja, v.title_en, v.employment_type,
          v.location_ja, v.location_en, v.salary_min, v.salary_max,
          v.salary_type, v.salary_note_ja, v.salary_note_en,
          v.working_hours_ja, v.working_hours_en, v.holidays_ja, v.holidays_en,
          v.description_ja, v.description_en, v.status, v.sort_order,
          v.published_at
        );
        vacancyId = res.lastInsertRowid;
        console.log(`Inserted new vacancy ${v.job_code} (ID: ${vacancyId})`);
      }

      // Clear existing sub-items to ensure clean synchronization
      db.prepare('DELETE FROM job_responsibilities WHERE job_vacancy_id = ?').run(vacancyId);
      db.prepare('DELETE FROM job_requirements WHERE job_vacancy_id = ?').run(vacancyId);
      db.prepare('DELETE FROM job_benefits WHERE job_vacancy_id = ?').run(vacancyId);

      // Insert Responsibilities
      const insertResp = db.prepare(`
        INSERT INTO job_responsibilities (job_vacancy_id, title_ja, title_en, description_ja, description_en, sort_order)
        VALUES (?, ?, ?, ?, ?, ?)
      `);
      v.responsibilities.forEach((r, idx) => {
        insertResp.run(vacancyId, r.title_ja, r.title_en, r.description_ja, r.description_en, r.sort_order || (idx + 1));
      });

      // Insert Requirements
      const insertReq = db.prepare(`
        INSERT INTO job_requirements (job_vacancy_id, type, description_ja, description_en, sort_order)
        VALUES (?, ?, ?, ?, ?)
      `);
      v.requirements.forEach((reqItem, idx) => {
        insertReq.run(vacancyId, reqItem.type, reqItem.description_ja, reqItem.description_en, reqItem.sort_order || (idx + 1));
      });

      // Insert Benefits
      const insertBen = db.prepare(`
        INSERT INTO job_benefits (job_vacancy_id, title_ja, title_en, description_ja, description_en, sort_order)
        VALUES (?, ?, ?, ?, ?, ?)
      `);
      v.benefits.forEach((b, idx) => {
        insertBen.run(vacancyId, b.title_ja, b.title_en, b.description_ja, b.description_en, b.sort_order || (idx + 1));
      });
    });

    for (const v of vacancies) {
      insertOrUpdateVacancy(v);
    }

    console.log(`Successfully seeded ${vacancies.length} vacancies into: ${dbPath}`);
  } catch (err) {
    console.error(`Error seeding ${dbPath}:`, err);
  }
}
