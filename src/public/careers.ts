function escapeHtml(text: any): string {
  if (text === null || text === undefined) return '';
  return String(text)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

function nl2br(text: any): string {
  if (!text) return '';
  return escapeHtml(text).replace(/\r\n|\n|\r/g, '<br>');
}

interface CompanyInfo {
  name_ja?: string;
  name_en?: string;
  ceo_name_ja?: string;
  ceo_name_en?: string;
  phone?: string;
  email?: string;
  address_ja?: string;
  address_en?: string;
  license?: string;
  corporate_number?: string;
}

export function renderCareersIndexHtml(
  vacancies: any[],
  company: CompanyInfo,
  renderHeaderFn: (comp: any, active: string) => string,
  renderFooterFn: (comp: any) => string,
  renderSakanaFn: () => string,
  lang: string = 'ja'
): string {
  const publishedCount = vacancies.length;

  const cardsHtml = vacancies.length > 0
    ? vacancies.map((v: any) => {
        const empTypeJa = v.employment_type === 'full_time' ? '正社員' : v.employment_type === 'contract' ? '契約社員' : v.employment_type === 'part_time' ? 'パート・アルバイト' : '正社員';
        const empTypeEn = v.employment_type === 'full_time' ? 'Full-Time' : v.employment_type === 'contract' ? 'Contract' : v.employment_type === 'part_time' ? 'Part-Time' : 'Full-Time';

        const topResps = (v.responsibilities || []).slice(0, 3);
        const reqs = v.requirements || [];
        const requiredCount = reqs.filter((r: any) => r.type === 'required').length;

        return `
          <div class="career-card" data-employment="${escapeHtml(v.employment_type || 'full_time')}">
            <div class="career-card-header">
              <div class="career-badges">
                <span class="badge-code">${escapeHtml(v.job_code || 'MIR-JOB')}</span>
                <span class="badge-type">
                  <span class="lang-ja">${empTypeJa}</span>
                  <span class="lang-en">${empTypeEn}</span>
                </span>
                <span class="badge-status-open">
                  <span class="lang-ja">● 募集中</span>
                  <span class="lang-en">● Open</span>
                </span>
              </div>
              <div class="career-date">
                <span class="lang-ja">掲載: ${(v.published_at || '').slice(0, 10)}</span>
                <span class="lang-en">Posted: ${(v.published_at || '').slice(0, 10)}</span>
              </div>
            </div>

            <h3 class="career-title">
              <a href="/careers/${escapeHtml(v.job_code || v.id)}" class="career-title-link">
                <span class="lang-ja">${escapeHtml(v.title_ja)}</span>
                <span class="lang-en">${escapeHtml(v.title_en)}</span>
              </a>
            </h3>

            <div class="career-meta-grid">
              <div class="meta-item">
                <span class="meta-icon">📍</span>
                <div>
                  <div class="meta-label"><span class="lang-ja">勤務地</span><span class="lang-en">Location</span></div>
                  <div class="meta-val">
                    <span class="lang-ja">${escapeHtml(v.location_ja || '東京都小金井市')}</span>
                    <span class="lang-en">${escapeHtml(v.location_en || 'Koganei-shi, Tokyo')}</span>
                  </div>
                </div>
              </div>

              <div class="meta-item">
                <span class="meta-icon">💴</span>
                <div>
                  <div class="meta-label"><span class="lang-ja">給与目安</span><span class="lang-en">Salary</span></div>
                  <div class="meta-val highlight">
                    <span class="lang-ja">${escapeHtml(v.salary_note_ja || (v.salary_min ? `月給 ${v.salary_min.toLocaleString()}円〜` : '応相談'))}</span>
                    <span class="lang-en">${escapeHtml(v.salary_note_en || (v.salary_min ? `Monthly JPY ${v.salary_min.toLocaleString()}~` : 'Negotiable'))}</span>
                  </div>
                </div>
              </div>

              <div class="meta-item">
                <span class="meta-icon">⏰</span>
                <div>
                  <div class="meta-label"><span class="lang-ja">勤務時間</span><span class="lang-en">Hours</span></div>
                  <div class="meta-val">
                    <span class="lang-ja">${escapeHtml(v.working_hours_ja || '9:00〜18:00（実働8h）')}</span>
                    <span class="lang-en">${escapeHtml(v.working_hours_en || '9:00 - 18:00 (8h)')}</span>
                  </div>
                </div>
              </div>

              <div class="meta-item">
                <span class="meta-icon">🏖️</span>
                <div>
                  <div class="meta-label"><span class="lang-ja">休日</span><span class="lang-en">Holidays</span></div>
                  <div class="meta-val">
                    <span class="lang-ja">${escapeHtml(v.holidays_ja ? (v.holidays_ja.length > 25 ? v.holidays_ja.slice(0, 25) + '...' : v.holidays_ja) : '完全週休2日制（土日祝）')}</span>
                    <span class="lang-en">${escapeHtml(v.holidays_en ? (v.holidays_en.length > 30 ? v.holidays_en.slice(0, 30) + '...' : v.holidays_en) : '5-day work week (Sat, Sun off)')}</span>
                  </div>
                </div>
              </div>
            </div>

            <p class="career-desc-snip">
              <span class="lang-ja">${escapeHtml(v.description_ja ? (v.description_ja.length > 140 ? v.description_ja.slice(0, 140) + '...' : v.description_ja) : '')}</span>
              <span class="lang-en">${escapeHtml(v.description_en ? (v.description_en.length > 160 ? v.description_en.slice(0, 160) + '...' : v.description_en) : '')}</span>
            </p>

            ${topResps.length > 0 ? `
              <div class="career-highlights-box">
                <div class="highlights-title">
                  <span class="lang-ja">主な担当業務</span>
                  <span class="lang-en">Key Responsibilities</span>
                </div>
                <ul class="highlights-list">
                  ${topResps.map((r: any, idx: number) => `
                    <li>
                      <strong>${idx + 1}.</strong>
                      <span class="lang-ja">${escapeHtml(r.title_ja)}</span>
                      <span class="lang-en">${escapeHtml(r.title_en)}</span>
                    </li>
                  `).join('')}
                </ul>
              </div>
            ` : ''}

            <div class="career-card-actions">
              <a href="/careers/${escapeHtml(v.job_code || v.id)}" class="btn-view-detail">
                <span class="lang-ja">募集要項・詳細を見る</span>
                <span class="lang-en">View Full Details</span>
                <span>→</span>
              </a>
              <button type="button" class="btn-quick-apply" onclick="openApplyModal('${escapeHtml(v.job_code)}', '${escapeHtml(v.title_ja)}', '${escapeHtml(v.title_en)}')">
                <span class="lang-ja">✉️ 応募する</span>
                <span class="lang-en">✉️ Quick Apply</span>
              </button>
            </div>
          </div>
        `;
      }).join('')
    : `
      <div class="career-empty-state">
        <div class="empty-icon">📂</div>
        <h3>
          <span class="lang-ja">現在、公開中の求人情報はございません</span>
          <span class="lang-en">No open positions currently listed</span>
        </h3>
        <p>
          <span class="lang-ja">新ポジションの募集開始次第、本ページにてご案内いたします。採用に関するご相談や事前のお問い合わせは、お問い合わせフォームよりお気軽にご連絡ください。</span>
          <span class="lang-en">New positions will be announced here. For career inquiries or open applications, please feel free to reach out via our contact form.</span>
        </p>
        <a href="/#contact" class="btn-primary" style="margin-top: 16px; display: inline-flex;">
          <span class="lang-ja">お問い合わせフォームへ</span>
          <span class="lang-en">Contact Form</span>
          <span>→</span>
        </a>
      </div>
    `;

  return `<!DOCTYPE html>
<html lang="${lang}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>採用情報 (Careers) | ${escapeHtml(company.name_ja || 'MIRANSH合同会社')} 本社自社採用</title>
  <meta name="description" content="MIRANSH合同会社の自社求人・採用情報。東京都小金井市本社での海外人材コーディネーター、一般事務・経理補助など、多文化共生社会をリードする仲間を募集しています。">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://miransh.co.jp/careers">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://miransh.co.jp/careers">
  <meta property="og:title" content="採用情報 (Careers) | MIRANSH合同会社 本社自社採用">
  <meta property="og:description" content="MIRANSH合同会社 本社（東京都小金井市）の正社員・契約社員採用情報。海外人材コーディネーター、バックオフィス総合職募集。">
  <meta property="og:image" content="https://miransh.co.jp/images/hero_banner.jpg">
  <meta property="og:site_name" content="MIRANSH合同会社">

  <link rel="stylesheet" href="/css/app.css">
  <link rel="icon" type="image/png" href="/images/logo-icon.png">

  <style>
    .careers-hero {
      background: linear-gradient(135deg, #0F2C59 0%, #1E3A8A 60%, #172554 100%);
      color: #FFFFFF;
      padding: clamp(48px, 8vw, 84px) 0 40px;
      position: relative;
      overflow: hidden;
    }
    .careers-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.25), transparent 60%);
      pointer-events: none;
    }
    .hero-badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 9999px;
      padding: 6px 16px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.5px;
      color: #93C5FD;
      margin-bottom: 16px;
    }
    .careers-hero h1 {
      font-size: clamp(28px, 5vw, 44px);
      font-weight: 800;
      line-height: 1.25;
      margin-bottom: 16px;
      letter-spacing: -0.5px;
    }
    .careers-hero p.hero-subtitle {
      font-size: clamp(15px, 2vw, 18px);
      line-height: 1.7;
      color: #E2E8F0;
      max-width: 820px;
      margin-bottom: 24px;
    }

    .internal-notice-card {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      padding: 16px 20px;
      display: flex;
      align-items: flex-start;
      gap: 14px;
      max-width: 820px;
      backdrop-filter: blur(8px);
    }
    .notice-icon {
      font-size: 22px;
      flex-shrink: 0;
      line-height: 1;
      margin-top: 2px;
    }
    .notice-text {
      font-size: 13.5px;
      line-height: 1.6;
      color: #F1F5F9;
    }
    .notice-text strong {
      color: #60A5FA;
    }

    /* Culture Highlights Grid */
    .culture-section {
      padding: 50px 0 30px;
      background: #F8FAFC;
      border-bottom: 1px solid #E2E8F0;
    }
    .culture-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
      margin-top: 24px;
    }
    .culture-card {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.02);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .culture-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }
    .culture-card-icon {
      font-size: 28px;
      margin-bottom: 12px;
      display: inline-block;
    }
    .culture-card h4 {
      font-size: 16px;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 8px;
    }
    .culture-card p {
      font-size: 13.5px;
      color: #475569;
      line-height: 1.6;
      margin: 0;
    }

    /* Vacancy Cards Section */
    .vacancies-list-section {
      padding: 60px 0 90px;
    }
    .section-header-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-end;
      gap: 16px;
      margin-bottom: 32px;
    }
    .filter-tabs {
      display: inline-flex;
      background: #F1F5F9;
      padding: 4px;
      border-radius: 10px;
      gap: 4px;
    }
    .filter-tab {
      border: none;
      background: transparent;
      padding: 8px 18px;
      font-size: 14px;
      font-weight: 700;
      color: #64748B;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .filter-tab.active {
      background: #FFFFFF;
      color: #0F2C59;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .careers-grid {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .career-card {
      background: #FFFFFF;
      border: 1px solid #CBD5E1;
      border-radius: 16px;
      padding: clamp(20px, 4vw, 32px);
      box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
      transition: all 0.25s ease;
      position: relative;
    }
    .career-card:hover {
      border-color: #3B82F6;
      box-shadow: 0 12px 28px rgba(37, 99, 235, 0.1);
    }
    .career-card-header {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      margin-bottom: 14px;
    }
    .career-badges {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      align-items: center;
    }
    .badge-code {
      background: #EFF6FF;
      color: #1D4ED8;
      border: 1px solid #BFDBFE;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 800;
      font-family: monospace;
      letter-spacing: 0.5px;
    }
    .badge-type {
      background: #ECFDF5;
      color: #047857;
      border: 1px solid #A7F3D0;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 700;
    }
    .badge-status-open {
      background: #F0FDF4;
      color: #15803D;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 700;
    }
    .career-date {
      font-size: 12px;
      color: #64748B;
      font-weight: 600;
    }

    .career-title {
      font-size: clamp(20px, 3vw, 24px);
      font-weight: 800;
      color: #0F172A;
      line-height: 1.35;
      margin-bottom: 18px;
    }
    .career-title-link {
      color: #0F172A;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    .career-title-link:hover {
      color: #2563EB;
    }

    .career-meta-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 14px;
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      padding: 16px 20px;
      margin-bottom: 20px;
    }
    .meta-item {
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }
    .meta-icon {
      font-size: 18px;
      line-height: 1.2;
    }
    .meta-label {
      font-size: 11px;
      font-weight: 700;
      color: #64748B;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 2px;
    }
    .meta-val {
      font-size: 13.5px;
      font-weight: 700;
      color: #1E293B;
      line-height: 1.4;
    }
    .meta-val.highlight {
      color: #047857;
      font-size: 14px;
    }

    .career-desc-snip {
      font-size: 14.5px;
      color: #334155;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .career-highlights-box {
      background: #EFF6FF;
      border-left: 4px solid #3B82F6;
      border-radius: 0 10px 10px 0;
      padding: 14px 18px;
      margin-bottom: 24px;
    }
    .highlights-title {
      font-size: 12px;
      font-weight: 800;
      color: #1E3A8A;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 6px;
    }
    .highlights-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .highlights-list li {
      font-size: 13.5px;
      color: #1E293B;
      line-height: 1.5;
    }
    .highlights-list strong {
      color: #2563EB;
      margin-right: 4px;
    }

    .career-card-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      align-items: center;
      border-top: 1px solid #F1F5F9;
      padding-top: 18px;
    }
    .btn-view-detail {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #0F2C59;
      color: #FFFFFF;
      font-weight: 700;
      font-size: 14px;
      padding: 11px 22px;
      border-radius: 8px;
      text-decoration: none;
      transition: background 0.2s ease;
    }
    .btn-view-detail:hover {
      background: #1E3A8A;
      color: #FFFFFF;
    }
    .btn-quick-apply {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #FFFFFF;
      color: #047857;
      border: 1.5px solid #059669;
      font-weight: 700;
      font-size: 14px;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .btn-quick-apply:hover {
      background: #ECFDF5;
      color: #065F46;
    }

    .career-empty-state {
      background: #FFFFFF;
      border: 2px dashed #CBD5E1;
      border-radius: 16px;
      padding: 60px 24px;
      text-align: center;
      max-width: 680px;
      margin: 0 auto;
    }
    .empty-icon {
      font-size: 48px;
      margin-bottom: 16px;
    }
    .career-empty-state h3 {
      font-size: 20px;
      font-weight: 800;
      color: #0F172A;
      margin-bottom: 12px;
    }
    .career-empty-state p {
      font-size: 14px;
      color: #64748B;
      line-height: 1.7;
    }

    /* Modal Styling */
    .apply-modal-backdrop {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(4px);
      z-index: 9999;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .apply-modal-backdrop.active {
      display: flex;
    }
    .apply-modal-box {
      background: #FFFFFF;
      border-radius: 16px;
      width: 100%;
      max-width: 580px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 20px 40px rgba(0,0,0,0.25);
      animation: modalFadeIn 0.25s ease;
    }
    @keyframes modalFadeIn {
      from { opacity: 0; transform: scale(0.96); }
      to { opacity: 1; transform: scale(1); }
    }
    .apply-modal-header {
      background: #0F2C59;
      color: #FFFFFF;
      padding: 18px 24px;
      border-radius: 16px 16px 0 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .apply-modal-header h3 {
      font-size: 18px;
      font-weight: 800;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .modal-close-btn {
      background: transparent;
      border: none;
      color: #FFFFFF;
      font-size: 22px;
      cursor: pointer;
      line-height: 1;
      padding: 4px 8px;
      border-radius: 6px;
    }
    .modal-close-btn:hover {
      background: rgba(255, 255, 255, 0.15);
    }
    .apply-modal-body {
      padding: 24px;
    }
  </style>
</head>
<body class="${lang}">
  ${renderHeaderFn(company, 'careers')}

  <!-- Hero Section -->
  <section class="careers-hero">
    <div class="container">
      <div class="hero-badge-pill">
        <span>🏢</span>
        <span class="lang-ja">MIRANSH合同会社 本社自社採用</span>
        <span class="lang-en">MIRANSH LLC Headquarters Direct Recruitment</span>
      </div>

      <h1>
        <span class="lang-ja">多文化共生の架け橋として、<br>未来を拓く仲間を募集します</span>
        <span class="lang-en">Join MIRANSH LLC as a Global Bridge<br>Connecting Talent with Japan</span>
      </h1>

      <p class="hero-subtitle">
        <span class="lang-ja">MIRANSH合同会社（東京都小金井市）では、日本企業とネパールをはじめとする優秀な外国人財を結ぶ総合職（正社員）を募集しています。海外人材コーディネートからオフィス管理、生活支援まで、あなたの語学力や熱意をダイレクトに活かせる職場です。</span>
        <span class="lang-en">We are directly seeking passionate, bilingual team members for our Tokyo headquarters. Grow your career as a Global Talent Coordinator and Back-Office Administrator supporting international candidates and Japanese enterprises.</span>
      </p>

      <div class="internal-notice-card">
        <div class="notice-icon">🛡️</div>
        <div class="notice-text">
          <span class="lang-ja"><strong>【MIRANSH自社直接雇用の求人です】</strong> 当ページに掲載されている求人情報は、すべてMIRANSH合同会社本社で勤務する正社員・契約社員の直接募集です。クライアント企業への人材紹介案件ではございません。</span>
          <span class="lang-en"><strong>[Direct Internal Hiring at MIRANSH LLC]</strong> All vacancies on this page are for direct internal employment at our Tokyo headquarters, not client companies.</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Workplace Strengths Section -->
  <section class="culture-section">
    <div class="container">
      <div style="text-align: center; max-width: 680px; margin: 0 auto;">
        <h2 style="font-size: 24px; font-weight: 800; color: #0F172A; margin-bottom: 8px;">
          <span class="lang-ja">MIRANSHで働く魅力と環境</span>
          <span class="lang-en">Why Work at MIRANSH LLC</span>
        </h2>
        <p style="font-size: 14px; color: #64748B;">
          <span class="lang-ja">国境を越えた挑戦を支え、自らも大きく成長できる安心・充実の労働環境</span>
          <span class="lang-en">A supportive, cross-cultural workspace where you can make a tangible social impact</span>
        </p>
      </div>

      <div class="culture-grid">
        <div class="culture-card">
          <span class="culture-card-icon">🌐</span>
          <h4>
            <span class="lang-ja">日英ネパール語の多文化共生</span>
            <span class="lang-en">Global Multicultural Culture</span>
          </h4>
          <p>
            <span class="lang-ja">日本とネパールにルーツを持つチームが一体となり、語学力や異文化理解を日々の実務でダイレクトに発揮できます。</span>
            <span class="lang-en">Work alongside a passionate bilingual team connecting Japan with Nepal, utilizing language and cultural expertise.</span>
          </p>
        </div>

        <div class="culture-card">
          <span class="culture-card-icon">📍</span>
          <h4>
            <span class="lang-ja">東京都小金井市（JR中央線）</span>
            <span class="lang-en">Tokyo Headquarters Access</span>
          </h4>
          <p>
            <span class="lang-ja">JR中央線（東小金井・武蔵小金井）や西武多摩川線（新小金井）からアクセス良好。落ち着いた環境で業務に専念できます。</span>
            <span class="lang-en">Convenient office location near Higashi-Koganei / Shin-Koganei stations on JR Chuo and Seibu Tamagawa lines.</span>
          </p>
        </div>

        <div class="culture-card">
          <span class="culture-card-icon">💼</span>
          <h4>
            <span class="lang-ja">総合職としての幅広いスキル</span>
            <span class="lang-en">Comprehensive Career Growth</span>
          </h4>
          <p>
            <span class="lang-ja">人材マッチング、特定技能ビザ書類作成、一般事務・経理補助まで、組織を支える多彩なビジネススキルが身につきます。</span>
            <span class="lang-en">Gain hands-on experience across recruitment coordination, visa documentation, and core accounting/administrative functions.</span>
          </p>
        </div>

        <div class="culture-card">
          <span class="culture-card-icon">🛡️</span>
          <h4>
            <span class="lang-ja">各種社会保険・ビザ支援完備</span>
            <span class="lang-en">Full Social Insurance & Visa</span>
          </h4>
          <p>
            <span class="lang-ja">健康保険・厚生年金・雇用労災の完備はもちろん、外国籍社員の在留資格（就労ビザ）更新・変更手続きも会社が全面的に支援します。</span>
            <span class="lang-en">Complete social insurance, annual reviews, and full company sponsorship for foreign national work visa renewals.</span>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Vacancies List Section -->
  <section class="vacancies-list-section" id="positions">
    <div class="container">
      <div class="section-header-row">
        <div>
          <h2 style="font-size: 26px; font-weight: 800; color: #0F172A; margin-bottom: 6px;">
            <span class="lang-ja">募集中のポジション一覧 (${publishedCount}件)</span>
            <span class="lang-en">Current Open Vacancies (${publishedCount})</span>
          </h2>
          <p style="font-size: 14px; color: #64748B; margin: 0;">
            <span class="lang-ja">各求人の詳細・応募要件をご確認のうえ、専用フォームよりエントリーしてください。</span>
            <span class="lang-en">Review job details and requirements, then apply directly via the form.</span>
          </p>
        </div>

        <div class="filter-tabs">
          <button type="button" class="filter-tab active" onclick="filterPositions('all', this)">
            <span class="lang-ja">すべて</span><span class="lang-en">All</span>
          </button>
          <button type="button" class="filter-tab" onclick="filterPositions('full_time', this)">
            <span class="lang-ja">正社員</span><span class="lang-en">Full-Time</span>
          </button>
          <button type="button" class="filter-tab" onclick="filterPositions('contract', this)">
            <span class="lang-ja">契約社員</span><span class="lang-en">Contract</span>
          </button>
        </div>
      </div>

      <div class="careers-grid" id="careers-grid-container">
        ${cardsHtml}
      </div>
    </div>
  </section>

  <!-- Quick Apply Modal -->
  <div id="quick-apply-modal" class="apply-modal-backdrop" onclick="closeApplyModalOnBackdrop(event)">
    <div class="apply-modal-box" onclick="event.stopPropagation()">
      <div class="apply-modal-header">
        <h3>
          <span>✉️</span>
          <span class="lang-ja">求人応募エントリー</span>
          <span class="lang-en">Job Application</span>
        </h3>
        <button type="button" class="modal-close-btn" onclick="closeApplyModal()" aria-label="閉じる">✕</button>
      </div>

      <div class="apply-modal-body">
        <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px;">
          <div style="font-size: 11px; font-weight: 800; color: #1E40AF; text-transform: uppercase;">応募ポジション / Position</div>
          <div id="modal-job-display" style="font-weight: 700; color: #0F172A; font-size: 15px; margin-top: 2px;"></div>
        </div>

        <form id="careers-apply-form" method="POST" action="/careers/apply" onsubmit="handleApplyFormSubmit(event)">
          <input type="hidden" name="job_code" id="modal_input_job_code" value="">
          <input type="hidden" name="job_title" id="modal_input_job_title" value="">

          <div class="form-group mb-3">
            <label class="form-label" style="font-weight: 700; font-size: 13px; color: #1E293B; margin-bottom: 6px; display: block;">
              <span class="lang-ja">お名前 (氏名)</span>
              <span class="lang-en">Full Name</span>
              <span style="color: #DC2626;">*</span>
            </label>
            <input type="text" name="name" id="apply_name" class="form-control" required placeholder="山田 太郎 / Taro Yamada" style="width: 100%; padding: 10px 14px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 14px;">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" style="font-weight: 700; font-size: 13px; color: #1E293B; margin-bottom: 6px; display: block;">
              <span class="lang-ja">メールアドレス</span>
              <span class="lang-en">Email Address</span>
              <span style="color: #DC2626;">*</span>
            </label>
            <input type="email" name="email" id="apply_email" class="form-control" required placeholder="applicant@example.com" style="width: 100%; padding: 10px 14px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 14px;">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" style="font-weight: 700; font-size: 13px; color: #1E293B; margin-bottom: 6px; display: block;">
              <span class="lang-ja">お電話番号</span>
              <span class="lang-en">Phone Number</span>
            </label>
            <input type="tel" name="phone" id="apply_phone" class="form-control" placeholder="090-0000-0000" style="width: 100%; padding: 10px 14px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 14px;">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" style="font-weight: 700; font-size: 13px; color: #1E293B; margin-bottom: 6px; display: block;">
              <span class="lang-ja">現在の在留資格・国籍（外国籍の方）</span>
              <span class="lang-en">Current Visa / Nationality</span>
            </label>
            <input type="text" name="visa_status" id="apply_visa" class="form-control" placeholder="例: 日本国籍、技術・人文知識・国際業務、永住者など" style="width: 100%; padding: 10px 14px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 14px;">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" style="font-weight: 700; font-size: 13px; color: #1E293B; margin-bottom: 6px; display: block;">
              <span class="lang-ja">志望動機・自己PR・経歴要約</span>
              <span class="lang-en">Cover Note / Self PR</span>
              <span style="color: #DC2626;">*</span>
            </label>
            <textarea name="message" id="apply_message" rows="4" class="form-control" required placeholder="これまでの職歴、語学スキル（日本語・英語・ネパール語等）、応募理由などをご記入ください。" style="width: 100%; padding: 10px 14px; border: 1px solid #CBD5E1; border-radius: 8px; font-size: 14px; line-height: 1.6;"></textarea>
          </div>

          <!-- Spam Honeypot -->
          <div style="position: absolute; left: -9999px; opacity: 0; pointer-events: none;" aria-hidden="true">
            <input type="text" name="website_url" tabindex="-1" autocomplete="off">
          </div>

          <div id="apply-status-box" style="display: none; padding: 12px; border-radius: 8px; margin-bottom: 14px; font-size: 13.5px; font-weight: 600;"></div>

          <button type="submit" id="btn-apply-submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 12px; font-size: 15px;">
            <span class="lang-ja">応募内容を送信する</span>
            <span class="lang-en">Submit Application</span>
            <span>→</span>
          </button>
        </form>
      </div>
    </div>
  </div>

  ${renderFooterFn(company)}
  ${renderSakanaFn()}

  <script src="/js/app.js"></script>
  <script>
    function filterPositions(type, btn) {
      document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const cards = document.querySelectorAll('.career-card');
      cards.forEach(card => {
        const cardType = card.getAttribute('data-employment');
        if (type === 'all' || cardType === type) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }

    function openApplyModal(code, titleJa, titleEn) {
      const modal = document.getElementById('quick-apply-modal');
      document.getElementById('modal_input_job_code').value = code;
      document.getElementById('modal_input_job_title').value = titleJa + ' (' + titleEn + ')';
      document.getElementById('modal-job-display').textContent = '[' + code + '] ' + titleJa;
      document.getElementById('apply-status-box').style.display = 'none';
      modal.classList.add('active');
    }

    function closeApplyModal() {
      document.getElementById('quick-apply-modal').classList.remove('active');
    }

    function closeApplyModalOnBackdrop(e) {
      if (e.target.id === 'quick-apply-modal') {
        closeApplyModal();
      }
    }

    async function handleApplyFormSubmit(e) {
      e.preventDefault();
      const form = e.target;
      const btn = document.getElementById('btn-apply-submit');
      const statusBox = document.getElementById('apply-status-box');

      btn.disabled = true;
      btn.innerHTML = '<span>⏳ 送信中... / Submitting...</span>';

      const formData = new FormData(form);
      const payload = {};
      formData.forEach((val, key) => { payload[key] = val; });

      try {
        const res = await fetch('/careers/apply', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok && data.success) {
          statusBox.style.display = 'block';
          statusBox.style.background = '#ECFDF5';
          statusBox.style.border = '1px solid #6EE7B7';
          statusBox.style.color = '#065F46';
          statusBox.innerHTML = '✓ 応募を受け付けました。MIRANSH採用担当より折り返しご連絡申し上げます。<br><span style="font-size: 12px; font-weight: 400;">Your application has been received. Our recruitment team will review it and get in touch.</span>';
          form.reset();
          btn.style.display = 'none';
          setTimeout(() => {
            closeApplyModal();
            btn.disabled = false;
            btn.style.display = '';
            btn.innerHTML = '<span>応募内容を送信する</span><span>Submit</span><span>→</span>';
          }, 3500);
        } else {
          throw new Error(data.error || 'Submission failed');
        }
      } catch (err) {
        statusBox.style.display = 'block';
        statusBox.style.background = '#FEF2F2';
        statusBox.style.border = '1px solid #FECACA';
        statusBox.style.color = '#991B1B';
        statusBox.textContent = '✗ エラーが発生しました: ' + (err.message || '送信に失敗しました。');
        btn.disabled = false;
        btn.innerHTML = '<span>再試行する / Retry</span>';
      }
    }
  </script>
</body>
</html>`;
}

export function renderCareersDetailHtml(
  vacancy: any,
  company: CompanyInfo,
  renderHeaderFn: (comp: any, active: string) => string,
  renderFooterFn: (comp: any) => string,
  renderSakanaFn: () => string,
  lang: string = 'ja'
): string {
  const empTypeJa = vacancy.employment_type === 'full_time' ? '正社員' : vacancy.employment_type === 'contract' ? '契約社員' : vacancy.employment_type === 'part_time' ? 'パート・アルバイト' : '正社員';
  const empTypeEn = vacancy.employment_type === 'full_time' ? 'Full-Time' : vacancy.employment_type === 'contract' ? 'Contract' : vacancy.employment_type === 'part_time' ? 'Part-Time' : 'Full-Time';

  const resps = vacancy.responsibilities || [];
  const reqs = vacancy.requirements || [];
  const requiredReqs = reqs.filter((r: any) => r.type === 'required');
  const preferredReqs = reqs.filter((r: any) => r.type === 'preferred');
  const bens = vacancy.benefits || [];

  return `<!DOCTYPE html>
<html lang="${lang}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>${escapeHtml(vacancy.title_ja)} | 採用情報 (Careers) | ${escapeHtml(company.name_ja || 'MIRANSH合同会社')}</title>
  <meta name="description" content="${escapeHtml(vacancy.title_ja)}の求人募集要項。MIRANSH合同会社（東京都小金井市）自社採用情報。">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://miransh.co.jp/careers/${escapeHtml(vacancy.job_code)}">

  <!-- Open Graph -->
  <meta property="og:type" content="article">
  <meta property="og:url" content="https://miransh.co.jp/careers/${escapeHtml(vacancy.job_code)}">
  <meta property="og:title" content="${escapeHtml(vacancy.title_ja)} | MIRANSH合同会社 自社採用">
  <meta property="og:description" content="${escapeHtml(vacancy.title_ja)} - 給与: ${escapeHtml(vacancy.salary_note_ja || '月給22万円〜25万円')} 勤務地: 東京都小金井市">
  <meta property="og:image" content="https://miransh.co.jp/images/hero_banner.jpg">
  <meta property="og:site_name" content="MIRANSH合同会社">

  <link rel="stylesheet" href="/css/app.css">
  <link rel="icon" type="image/png" href="/images/logo-icon.png">

  <style>
    .breadcrumb-nav {
      background: #F8FAFC;
      border-bottom: 1px solid #E2E8F0;
      padding: 12px 0;
      font-size: 13px;
    }
    .breadcrumb-list {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 8px;
      list-style: none;
      padding: 0;
      margin: 0;
      color: #64748B;
    }
    .breadcrumb-list a {
      color: #2563EB;
      text-decoration: none;
    }
    .breadcrumb-list a:hover {
      text-decoration: underline;
    }

    .detail-hero {
      background: linear-gradient(135deg, #0F2C59 0%, #1E3A8A 100%);
      color: #FFFFFF;
      padding: 40px 0;
    }
    .internal-badge-tag {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(37, 99, 235, 0.35);
      border: 1px solid rgba(147, 197, 253, 0.4);
      color: #93C5FD;
      padding: 4px 14px;
      border-radius: 9999px;
      font-size: 12.5px;
      font-weight: 700;
      margin-bottom: 14px;
    }

    .detail-main-layout {
      padding: 50px 0 90px;
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 36px;
    }
    @media (max-width: 991px) {
      .detail-main-layout {
        grid-template-columns: 1fr;
      }
    }

    .section-block {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 14px;
      padding: clamp(20px, 3.5vw, 32px);
      margin-bottom: 28px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    .section-block-title {
      font-size: 20px;
      font-weight: 800;
      color: #0F172A;
      margin-bottom: 20px;
      padding-bottom: 12px;
      border-bottom: 2px solid #F1F5F9;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Specs Table */
    .specs-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14.5px;
    }
    .specs-table tr {
      border-bottom: 1px solid #E2E8F0;
    }
    .specs-table tr:last-child {
      border-bottom: none;
    }
    .specs-table th {
      width: 28%;
      background: #F8FAFC;
      padding: 14px 18px;
      font-weight: 700;
      color: #334155;
      vertical-align: top;
      border-right: 1px solid #E2E8F0;
    }
    .specs-table td {
      padding: 14px 20px;
      color: #0F172A;
      line-height: 1.6;
    }

    /* Responsibilities cards */
    .resp-card {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 10px;
      padding: 18px 20px;
      margin-bottom: 14px;
      transition: all 0.2s ease;
    }
    .resp-card:hover {
      background: #EFF6FF;
      border-color: #BFDBFE;
    }
    .resp-card-head {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 6px;
    }
    .resp-num-badge {
      background: #2563EB;
      color: #FFFFFF;
      width: 26px;
      height: 26px;
      border-radius: 9999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 800;
      flex-shrink: 0;
    }
    .resp-card-title {
      font-size: 16px;
      font-weight: 800;
      color: #0F172A;
    }
    .resp-card-desc {
      font-size: 14px;
      color: #475569;
      line-height: 1.6;
      margin: 0;
      padding-left: 36px;
    }

    /* Requirements bullets */
    .req-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 10px 0;
      border-bottom: 1px dashed #E2E8F0;
    }
    .req-item:last-child {
      border-bottom: none;
    }
    .req-check {
      color: #10B981;
      font-size: 18px;
      line-height: 1.2;
      flex-shrink: 0;
    }
    .req-text {
      font-size: 14.5px;
      color: #1E293B;
      line-height: 1.6;
    }

    /* Benefits grid */
    .benefits-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 14px;
    }
    .benefit-box {
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
      border-radius: 10px;
      padding: 16px 18px;
    }
    .benefit-box h5 {
      font-size: 14.5px;
      font-weight: 700;
      color: #166534;
      margin-bottom: 4px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .benefit-box p {
      font-size: 13px;
      color: #15803D;
      line-height: 1.5;
      margin: 0;
    }

    /* Selection process steps */
    .selection-steps {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .step-item {
      display: flex;
      align-items: center;
      gap: 14px;
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 10px;
      padding: 14px 18px;
    }
    .step-badge {
      background: #0F2C59;
      color: #FFFFFF;
      padding: 4px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.5px;
      flex-shrink: 0;
    }
    .step-name {
      font-size: 14.5px;
      font-weight: 700;
      color: #0F172A;
    }

    /* Sidebar Sticky Box */
    .sidebar-apply-card {
      position: sticky;
      top: 90px;
      background: #FFFFFF;
      border: 1px solid #CBD5E1;
      border-radius: 14px;
      padding: 24px;
      box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
    }
    .sidebar-code-tag {
      font-family: monospace;
      font-weight: 800;
      color: #1D4ED8;
      background: #EFF6FF;
      padding: 3px 8px;
      border-radius: 4px;
      font-size: 12px;
      display: inline-block;
      margin-bottom: 10px;
    }
  </style>
</head>
<body class="${lang}">
  ${renderHeaderFn(company, 'careers')}

  <!-- Breadcrumbs -->
  <nav class="breadcrumb-nav">
    <div class="container">
      <ul class="breadcrumb-list">
        <li><a href="/"><span class="lang-ja">ホーム</span><span class="lang-en">Home</span></a></li>
        <li>/</li>
        <li><a href="/careers"><span class="lang-ja">採用情報</span><span class="lang-en">Careers</span></a></li>
        <li>/</li>
        <li style="color: #0F172A; font-weight: 700;"><span class="lang-ja">${escapeHtml(vacancy.title_ja)}</span><span class="lang-en">${escapeHtml(vacancy.title_en)}</span></li>
      </ul>
    </div>
  </nav>

  <!-- Detail Hero Banner -->
  <section class="detail-hero">
    <div class="container">
      <div class="internal-badge-tag">
        <span>🛡️</span>
        <span class="lang-ja">MIRANSH合同会社 本社自社採用（正社員・直接雇用）</span>
        <span class="lang-en">MIRANSH LLC Headquarters Direct Employment</span>
      </div>

      <div style="display: flex; gap: 8px; margin-bottom: 12px;">
        <span style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 4px; padding: 2px 8px; font-size: 12px; font-family: monospace; font-weight: 800;">
          ${escapeHtml(vacancy.job_code)}
        </span>
        <span style="background: #10B981; color: #FFFFFF; border-radius: 4px; padding: 2px 8px; font-size: 12px; font-weight: 700;">
          <span class="lang-ja">${empTypeJa}</span>
          <span class="lang-en">${empTypeEn}</span>
        </span>
      </div>

      <h1 style="font-size: clamp(24px, 4vw, 36px); font-weight: 800; line-height: 1.3; margin-bottom: 14px;">
        <span class="lang-ja">${escapeHtml(vacancy.title_ja)}</span>
        <span class="lang-en">${escapeHtml(vacancy.title_en)}</span>
      </h1>

      <div style="display: flex; flex-wrap: wrap; gap: 18px; font-size: 14px; color: #E2E8F0;">
        <div>📍 <span class="lang-ja">${escapeHtml(vacancy.location_ja || '東京都小金井市')}</span><span class="lang-en">${escapeHtml(vacancy.location_en || 'Koganei-shi, Tokyo')}</span></div>
        <div>💴 <span class="lang-ja">${escapeHtml(vacancy.salary_note_ja || '月給220,000円〜250,000円')}</span><span class="lang-en">${escapeHtml(vacancy.salary_note_en || 'Monthly JPY 220,000 - 250,000')}</span></div>
        <div>🗓️ <span class="lang-ja">掲載日: ${(vacancy.published_at || '').slice(0, 10)}</span><span class="lang-en">Posted: ${(vacancy.published_at || '').slice(0, 10)}</span></div>
      </div>
    </div>
  </section>

  <!-- Main Content Layout -->
  <div class="container">
    <div class="detail-main-layout">
      <!-- Left Column: Details -->
      <div>
        <!-- 1. Position Overview -->
        <div class="section-block">
          <h2 class="section-block-title">
            <span>📖</span>
            <span class="lang-ja">募集背景・職種概要</span>
            <span class="lang-en">Position Overview</span>
          </h2>
          <div style="font-size: 15px; color: #334155; line-height: 1.8;">
            <div class="lang-ja">${nl2br(vacancy.description_ja)}</div>
            <div class="lang-en">${nl2br(vacancy.description_en)}</div>
          </div>
        </div>

        <!-- 2. Employment Overview Specs Table -->
        <div class="section-block">
          <h2 class="section-block-title">
            <span>📋</span>
            <span class="lang-ja">募集要項・勤務条件</span>
            <span class="lang-en">Job Specifications</span>
          </h2>
          <table class="specs-table">
            <tbody>
              <tr>
                <th><span class="lang-ja">求人コード</span><span class="lang-en">Job Code</span></th>
                <td><code>${escapeHtml(vacancy.job_code)}</code></td>
              </tr>
              <tr>
                <th><span class="lang-ja">雇用形態</span><span class="lang-en">Employment</span></th>
                <td>
                  <strong><span class="lang-ja">${empTypeJa}</span><span class="lang-en">${empTypeEn}</span></strong>
                </td>
              </tr>
              <tr>
                <th><span class="lang-ja">勤務地</span><span class="lang-en">Location</span></th>
                <td>
                  <div class="lang-ja">${escapeHtml(vacancy.location_ja)}</div>
                  <div class="lang-en" style="font-size: 13.5px; color: #475569;">${escapeHtml(vacancy.location_en)}</div>
                  <div style="font-size: 13px; color: #64748B; margin-top: 4px;">
                    <span class="lang-ja">※ 最寄り駅: JR中央線「東小金井駅」「武蔵小金井駅」 / 西武多摩川線「新小金井駅」</span>
                    <span class="lang-en">Near Higashi-Koganei / Shin-Koganei Station</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th><span class="lang-ja">給与</span><span class="lang-en">Salary</span></th>
                <td>
                  <div style="font-size: 16px; font-weight: 800; color: #047857;">
                    <span class="lang-ja">${escapeHtml(vacancy.salary_note_ja || (vacancy.salary_min ? `月給 ${vacancy.salary_min.toLocaleString()}円〜` : '応相談'))}</span>
                    <span class="lang-en">${escapeHtml(vacancy.salary_note_en || (vacancy.salary_min ? `Monthly JPY ${vacancy.salary_min.toLocaleString()}~` : 'Negotiable'))}</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th><span class="lang-ja">勤務時間</span><span class="lang-en">Working Hours</span></th>
                <td>
                  <div class="lang-ja">${escapeHtml(vacancy.working_hours_ja || '9:00 〜 18:00（実働8時間、休憩60分）')}</div>
                  <div class="lang-en" style="font-size: 13.5px; color: #475569;">${escapeHtml(vacancy.working_hours_en || '9:00 - 18:00 (8 hours work, 60-min lunch break)')}</div>
                </td>
              </tr>
              <tr>
                <th><span class="lang-ja">休日・休暇</span><span class="lang-en">Holidays</span></th>
                <td>
                  <div class="lang-ja">${escapeHtml(vacancy.holidays_ja || '完全週休2日制（土日）、祝日、年末年始休暇、夏季休暇、年次有給休暇')}</div>
                  <div class="lang-en" style="font-size: 13.5px; color: #475569;">${escapeHtml(vacancy.holidays_en || '5-day work week (Saturdays, Sundays, Public holidays off)')}</div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 3. Key Responsibilities -->
        ${resps.length > 0 ? `
          <div class="section-block">
            <h2 class="section-block-title">
              <span>💼</span>
              <span class="lang-ja">仕事内容・主な担当業務</span>
              <span class="lang-en">Job Responsibilities</span>
            </h2>
            <div class="resp-list">
              ${resps.map((r: any, idx: number) => `
                <div class="resp-card">
                  <div class="resp-card-head">
                    <span class="resp-num-badge">${idx + 1}</span>
                    <h3 class="resp-card-title">
                      <span class="lang-ja">${escapeHtml(r.title_ja)}</span>
                      <span class="lang-en">${escapeHtml(r.title_en)}</span>
                    </h3>
                  </div>
                  ${(r.description_ja || r.description_en) ? `
                    <p class="resp-card-desc">
                      <span class="lang-ja">${nl2br(r.description_ja)}</span>
                      <span class="lang-en">${nl2br(r.description_en)}</span>
                    </p>
                  ` : ''}
                </div>
              `).join('')}
            </div>
          </div>
        ` : ''}

        <!-- 4. Requirements -->
        <div class="section-block">
          <h2 class="section-block-title">
            <span>🎯</span>
            <span class="lang-ja">応募条件・求めるスキル</span>
            <span class="lang-en">Requirements & Qualifications</span>
          </h2>

          ${requiredReqs.length > 0 ? `
            <div style="margin-bottom: 24px;">
              <h3 style="font-size: 15px; font-weight: 800; color: #DC2626; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                <span>●</span>
                <span class="lang-ja">必須条件 (Required)</span>
                <span class="lang-en">Required Qualifications</span>
              </h3>
              ${requiredReqs.map((rq: any) => `
                <div class="req-item">
                  <span class="req-check">✓</span>
                  <div class="req-text">
                    <span class="lang-ja">${escapeHtml(rq.description_ja)}</span>
                    <span class="lang-en">${escapeHtml(rq.description_en)}</span>
                  </div>
                </div>
              `).join('')}
            </div>
          ` : ''}

          ${preferredReqs.length > 0 ? `
            <div>
              <h3 style="font-size: 15px; font-weight: 800; color: #2563EB; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                <span>★</span>
                <span class="lang-ja">歓迎条件 (Preferred)</span>
                <span class="lang-en">Preferred Qualifications</span>
              </h3>
              ${preferredReqs.map((rq: any) => `
                <div class="req-item">
                  <span class="req-check" style="color: #3B82F6;">★</span>
                  <div class="req-text">
                    <span class="lang-ja">${escapeHtml(rq.description_ja)}</span>
                    <span class="lang-en">${escapeHtml(rq.description_en)}</span>
                  </div>
                </div>
              `).join('')}
            </div>
          ` : ''}
        </div>

        <!-- 5. Benefits -->
        ${bens.length > 0 ? `
          <div class="section-block">
            <h2 class="section-block-title">
              <span>🎁</span>
              <span class="lang-ja">待遇・福利厚生・サポート</span>
              <span class="lang-en">Benefits & Welfare</span>
            </h2>
            <div class="benefits-grid">
              ${bens.map((b: any) => `
                <div class="benefit-box">
                  <h5>
                    <span>✓</span>
                    <span class="lang-ja">${escapeHtml(b.title_ja)}</span>
                    <span class="lang-en">${escapeHtml(b.title_en)}</span>
                  </h5>
                  ${(b.description_ja || b.description_en) ? `
                    <p>
                      <span class="lang-ja">${escapeHtml(b.description_ja)}</span>
                      <span class="lang-en">${escapeHtml(b.description_en)}</span>
                    </p>
                  ` : ''}
                </div>
              `).join('')}
            </div>
          </div>
        ` : ''}

        <!-- 6. Selection Process -->
        <div class="section-block">
          <h2 class="section-block-title">
            <span>🔄</span>
            <span class="lang-ja">選考の流れ</span>
            <span class="lang-en">Hiring Process</span>
          </h2>
          <div class="selection-steps">
            <div class="step-item">
              <span class="step-badge">STEP 1</span>
              <div>
                <div class="step-name"><span class="lang-ja">エントリー・書類選考</span><span class="lang-en">Application & Resume Screening</span></div>
                <div style="font-size: 13px; color: #64748B;"><span class="lang-ja">本ページフォームまたは履歴書送付による選考</span><span class="lang-en">Initial screening based on submitted info</span></div>
              </div>
            </div>
            <div class="step-item">
              <span class="step-badge">STEP 2</span>
              <div>
                <div class="step-name"><span class="lang-ja">1次面接（オンラインまたは本社）</span><span class="lang-en">1st Interview (Online or In-Person)</span></div>
                <div style="font-size: 13px; color: #64748B;"><span class="lang-ja">担当者との面談（志望動機、語学力、ご経歴の確認）</span><span class="lang-en">Discussion on background & language capability</span></div>
              </div>
            </div>
            <div class="step-item">
              <span class="step-badge">STEP 3</span>
              <div>
                <div class="step-name"><span class="lang-ja">役員・代表面接（最終）</span><span class="lang-en">Final Leadership Interview</span></div>
                <div style="font-size: 13px; color: #64748B;"><span class="lang-ja">MIRANSH役員との面接・ビジョン共有</span><span class="lang-en">Final discussion with MIRANSH executive team</span></div>
              </div>
            </div>
            <div class="step-item" style="border-color: #A7F3D0; background: #F0FDF4;">
              <span class="step-badge" style="background: #059669;">STEP 4</span>
              <div>
                <div class="step-name" style="color: #065F46;"><span class="lang-ja">内定・雇用契約・入社手続き</span><span class="lang-en">Job Offer & Onboarding</span></div>
                <div style="font-size: 13px; color: #047857;"><span class="lang-ja">就労ビザ手続き（外国籍の方）および入社オリエンテーション</span><span class="lang-en">Visa renewal support & welcome orientation</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Sticky Apply Card -->
      <div>
        <div class="sidebar-apply-card">
          <span class="sidebar-code-tag">${escapeHtml(vacancy.job_code)}</span>
          <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin-bottom: 8px;">
            <span class="lang-ja">${escapeHtml(vacancy.title_ja)}</span>
            <span class="lang-en">${escapeHtml(vacancy.title_en)}</span>
          </h3>

          <div style="font-size: 13px; color: #475569; margin-bottom: 16px;">
            <span class="lang-ja">MIRANSH合同会社 本社直接雇用</span>
            <span class="lang-en">Direct Employment at MIRANSH LLC</span>
          </div>

          <div style="border-top: 1px solid #E2E8F0; padding-top: 16px; margin-bottom: 18px;">
            <div style="font-size: 12px; color: #64748B;">給与 / Salary</div>
            <div style="font-size: 16px; font-weight: 800; color: #047857;">
              <span class="lang-ja">${escapeHtml(vacancy.salary_note_ja || '月給22万円〜25万円')}</span>
              <span class="lang-en">${escapeHtml(vacancy.salary_note_en || 'Monthly JPY 220,000 - 250,000')}</span>
            </div>
          </div>

          <!-- Application Form -->
          <form id="detail-apply-form" method="POST" action="/careers/apply" onsubmit="handleDetailApplySubmit(event)">
            <input type="hidden" name="job_code" value="${escapeHtml(vacancy.job_code)}">
            <input type="hidden" name="job_title" value="${escapeHtml(vacancy.title_ja)} (${escapeHtml(vacancy.title_en)})">

            <div class="form-group mb-2">
              <label class="form-label" style="font-size: 12.5px; font-weight: 700; color: #1E293B; margin-bottom: 4px; display: block;">
                <span class="lang-ja">お名前</span><span class="lang-en">Name</span> <span style="color: #DC2626;">*</span>
              </label>
              <input type="text" name="name" required class="form-control" placeholder="山田 太郎 / Taro Yamada" style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13.5px;">
            </div>

            <div class="form-group mb-2">
              <label class="form-label" style="font-size: 12.5px; font-weight: 700; color: #1E293B; margin-bottom: 4px; display: block;">
                <span class="lang-ja">メール</span><span class="lang-en">Email</span> <span style="color: #DC2626;">*</span>
              </label>
              <input type="email" name="email" required class="form-control" placeholder="applicant@example.com" style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13.5px;">
            </div>

            <div class="form-group mb-2">
              <label class="form-label" style="font-size: 12.5px; font-weight: 700; color: #1E293B; margin-bottom: 4px; display: block;">
                <span class="lang-ja">お電話番号</span><span class="lang-en">Phone</span>
              </label>
              <input type="tel" name="phone" class="form-control" placeholder="090-0000-0000" style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13.5px;">
            </div>

            <div class="form-group mb-2">
              <label class="form-label" style="font-size: 12.5px; font-weight: 700; color: #1E293B; margin-bottom: 4px; display: block;">
                <span class="lang-ja">在留資格・国籍</span><span class="lang-en">Visa / Nationality</span>
              </label>
              <input type="text" name="visa_status" class="form-control" placeholder="日本国籍、技人国ビザなど" style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13.5px;">
            </div>

            <div class="form-group mb-3">
              <label class="form-label" style="font-size: 12.5px; font-weight: 700; color: #1E293B; margin-bottom: 4px; display: block;">
                <span class="lang-ja">志望動機・自己PR</span><span class="lang-en">Cover Note</span> <span style="color: #DC2626;">*</span>
              </label>
              <textarea name="message" rows="3" required class="form-control" placeholder="語学力、経歴、応募理由をご記入ください。" style="width: 100%; padding: 8px 12px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 13px; line-height: 1.5;"></textarea>
            </div>

            <!-- Spam Honeypot -->
            <div style="position: absolute; left: -9999px; opacity: 0; pointer-events: none;" aria-hidden="true">
              <input type="text" name="website_url" tabindex="-1" autocomplete="off">
            </div>

            <div id="detail-apply-status" style="display: none; padding: 10px; border-radius: 6px; margin-bottom: 12px; font-size: 13px; font-weight: 600;"></div>

            <button type="submit" id="btn-detail-apply" class="btn-primary" style="width: 100%; justify-content: center; padding: 12px; font-size: 15px; font-weight: 800;">
              <span class="lang-ja">このポジションに応募する</span>
              <span class="lang-en">Apply for this Position</span>
              <span>→</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  ${renderFooterFn(company)}
  ${renderSakanaFn()}

  <script src="/js/app.js"></script>
  <script>
    async function handleDetailApplySubmit(e) {
      e.preventDefault();
      const form = e.target;
      const btn = document.getElementById('btn-detail-apply');
      const statusBox = document.getElementById('detail-apply-status');

      btn.disabled = true;
      btn.innerHTML = '<span>⏳ 送信中... / Submitting...</span>';

      const formData = new FormData(form);
      const payload = {};
      formData.forEach((val, key) => { payload[key] = val; });

      try {
        const res = await fetch('/careers/apply', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const data = await res.json();
        if (res.ok && data.success) {
          statusBox.style.display = 'block';
          statusBox.style.background = '#ECFDF5';
          statusBox.style.border = '1px solid #6EE7B7';
          statusBox.style.color = '#065F46';
          statusBox.innerHTML = '✓ 応募を受け付けました。<br>MIRANSH採用担当より折り返しご連絡申し上げます。';
          form.reset();
          btn.style.display = 'none';
        } else {
          throw new Error(data.error || 'Submission failed');
        }
      } catch (err) {
        statusBox.style.display = 'block';
        statusBox.style.background = '#FEF2F2';
        statusBox.style.border = '1px solid #FECACA';
        statusBox.style.color = '#991B1B';
        statusBox.textContent = '✗ エラー: ' + (err.message || '送信に失敗しました');
        btn.disabled = false;
        btn.innerHTML = '<span>再試行する / Retry</span>';
      }
    }
  </script>
</body>
</html>`;
}
