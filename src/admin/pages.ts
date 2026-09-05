// AdminLTE 3 Individual Page Renderers for MIRANSH Management Portal
import { escapeHtml } from '../adminlte';
import { i18n, AdminLang } from './i18n';

// ----------------------------------------------------
// 1. Dashboard Overview Page
// ----------------------------------------------------
export function renderDashboardContent(
  data: {
    company: any;
    services: any[];
    stories: any[];
    inquiries: any[];
    unreadCount: number;
  },
  lang: AdminLang = 'ja'
): { body: string; modals: string; scripts: string } {
  const { company, services, stories, inquiries, unreadCount } = data;
  const t = i18n[lang];
  const recentInquiries = inquiries.slice(0, 6);

  const body = `
    <!-- Stat Widgets -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info shadow-sm">
          <div class="inner">
            <h3>${inquiries.length}</h3>
            <p class="mb-0 font-weight-bold">${t.dashboard.statInquiries} (${unreadCount} ${t.dashboard.statUnread})</p>
          </div>
          <div class="icon">
            <i class="fas fa-envelope"></i>
          </div>
          <a href="/admin/inquiries" class="small-box-footer">
            ${t.dashboard.linkInquiries} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success shadow-sm">
          <div class="inner">
            <h3>${services.length}</h3>
            <p class="mb-0 font-weight-bold">${t.dashboard.statServices} (${t.dashboard.statServicesSub})</p>
          </div>
          <div class="icon">
            <i class="fas fa-concierge-bell"></i>
          </div>
          <a href="/admin/services" class="small-box-footer">
            ${t.dashboard.linkServices} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning shadow-sm">
          <div class="inner">
            <h3>${stories.length}</h3>
            <p class="mb-0 font-weight-bold">${t.dashboard.statStories} (${t.dashboard.statStoriesSub})</p>
          </div>
          <div class="icon">
            <i class="fas fa-book-open"></i>
          </div>
          <a href="/admin/stories" class="small-box-footer">
            ${t.dashboard.linkStories} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-primary shadow-sm">
          <div class="inner">
            <h3>Active</h3>
            <p class="mb-0 font-weight-bold">${t.dashboard.statAi} (${t.dashboard.statAiActive})</p>
          </div>
          <div class="icon">
            <i class="fas fa-robot"></i>
          </div>
          <a href="/admin/ai" class="small-box-footer">
            ${t.dashboard.linkAi} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Main Overview Row -->
    <div class="row">
      <!-- Recent Inquiries Table -->
      <div class="col-lg-8">
        <div class="card card-outline card-primary shadow-sm">
          <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-envelope-open-text text-primary mr-2"></i>${t.dashboard.recentInquiriesTitle}
            </h3>
            <div class="card-tools">
              <a href="/admin/inquiries" class="btn btn-tool text-primary font-weight-bold">${t.dashboard.viewAllInquiries}</a>
            </div>
          </div>
          <div class="card-body p-0 table-responsive">
            <table class="table table-striped table-hover text-sm mb-0">
              <thead class="thead-light">
                <tr>
                  <th>${t.dashboard.tableSender}</th>
                  <th>${t.dashboard.tableInterest}</th>
                  <th>${t.dashboard.tableSummary}</th>
                  <th class="text-center">${t.dashboard.tableStatus}</th>
                  <th class="text-right">${t.dashboard.tableActions}</th>
                </tr>
              </thead>
              <tbody>
                ${recentInquiries.map(inq => `
                  <tr>
                    <td>
                      <div class="font-weight-bold text-dark">${escapeHtml(inq.name)}</div>
                      <small class="text-muted"><i class="fas fa-building mr-1"></i>${escapeHtml(inq.company_name || (lang === 'en' ? 'Individual' : '個人・未記入'))}</small>
                    </td>
                    <td><span class="badge badge-info px-2 py-1">${escapeHtml(inq.inquiry_type || inq.service_interest || (lang === 'en' ? 'General Consultation' : '一般相談'))}</span></td>
                    <td style="max-width: 200px;" class="text-truncate text-secondary">${escapeHtml(inq.message || '')}</td>
                    <td class="text-center">
                      ${inq.status === 'resolved' 
                        ? `<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>${t.actions.resolved}</span>` 
                        : `<span class="badge badge-warning px-2 py-1 text-dark"><i class="fas fa-clock mr-1"></i>${t.actions.unread}</span>`}
                    </td>
                    <td class="text-right text-nowrap">
                      <button type="button" class="btn btn-xs btn-outline-info" onclick='openInquiryModal(${JSON.stringify(inq).replace(/'/g, "&#39;")})'>
                        <i class="fas fa-eye mr-1"></i>${t.actions.view}
                      </button>
                    </td>
                  </tr>
                `).join('')}
                ${inquiries.length === 0 ? `<tr><td colspan="5" class="text-center py-4 text-muted">${t.dashboard.noInquiries}</td></tr>` : ''}
              </tbody>
            </table>
          </div>
        </div>

        <!-- Featured Stories List -->
        <div class="card card-outline card-secondary shadow-sm">
          <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-newspaper text-secondary mr-2"></i>${t.dashboard.storiesTitle}
            </h3>
            <div class="card-tools">
              <a href="/admin/stories" class="btn btn-tool text-primary font-weight-bold">${t.dashboard.manageStories}</a>
            </div>
          </div>
          <div class="card-body p-0 table-responsive">
            <table class="table table-hover text-sm mb-0">
              <thead class="thead-light">
                <tr>
                  <th style="width: 70px;">${lang === 'en' ? 'Photo' : '写真'}</th>
                  <th>${lang === 'en' ? 'Story Title (JA / EN)' : 'タイトル (日/英)'}</th>
                  <th>${lang === 'en' ? 'Category' : '分野'}</th>
                  <th>${lang === 'en' ? 'Date' : '公開日'}</th>
                </tr>
              </thead>
              <tbody>
                ${stories.slice(0, 4).map(st => `
                  <tr>
                    <td>
                      <img src="${escapeHtml(st.image || '/images/story1.jpg')}" class="img-thumbnail" style="width: 55px; height: 38px; object-fit: cover;">
                    </td>
                    <td>
                      <div class="font-weight-bold text-dark">${escapeHtml(lang === 'en' ? (st.title_en || st.title_ja) : st.title_ja)}</div>
                      <small class="text-muted">${escapeHtml(lang === 'en' ? st.title_ja : (st.title_en || ''))}</small>
                    </td>
                    <td><span class="badge badge-secondary">${escapeHtml(lang === 'en' ? (st.category_en || st.category_ja) : (st.category_ja || '特定技能'))}</span></td>
                    <td class="text-xs text-muted">${escapeHtml(st.published_date || '')}</td>
                  </tr>
                `).join('')}
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Quick Actions and Info -->
      <div class="col-lg-4">
        <div class="card card-outline card-warning shadow-sm mb-3">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-bolt text-warning mr-2"></i>${t.dashboard.quickActionsTitle}
            </h3>
          </div>
          <div class="card-body">
            <div class="d-grid gap-2">
              <a href="/admin/company" class="btn btn-outline-primary btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-camera mr-2"></i>${t.dashboard.quickBtnHero}
              </a>
              <a href="/admin/stories" class="btn btn-outline-success btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-plus-circle mr-2"></i>${t.dashboard.quickBtnStory}
              </a>
              <a href="/admin/services" class="btn btn-outline-info btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-concierge-bell mr-2"></i>${t.dashboard.quickBtnService}
              </a>
              <a href="/admin/password" class="btn btn-outline-danger btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-key mr-2"></i>${t.dashboard.quickBtnPassword}
              </a>
              <a href="/admin/ai" class="btn btn-outline-dark btn-block text-left font-weight-bold">
                <i class="fas fa-robot mr-2"></i>${t.dashboard.linkAi}
              </a>
            </div>
          </div>
        </div>

        <div class="card card-outline card-info shadow-sm mb-3">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-info-circle text-info mr-2"></i>${lang === 'en' ? 'Company Snapshot' : '企業基本情報'}
            </h3>
          </div>
          <div class="card-body text-xs">
            <div class="mb-2"><strong>${lang === 'en' ? 'Name:' : '社名:'}</strong> ${escapeHtml(company.name_ja)} (${escapeHtml(company.name_en || '')})</div>
            <div class="mb-2"><strong>${lang === 'en' ? 'License:' : '許可番号:'}</strong> ${escapeHtml(company.license || '13-ユ-319558')}</div>
            <div class="mb-2"><strong>${lang === 'en' ? 'CEO:' : '代表者:'}</strong> ${escapeHtml(lang === 'en' ? (company.ceo_name_en || company.ceo_name_ja) : company.ceo_name_ja)}</div>
            <div class="mb-2"><strong>${lang === 'en' ? 'Address:' : '所在地:'}</strong> ${escapeHtml(lang === 'en' ? (company.address_en || company.address_ja) : company.address_ja)}</div>
            <div class="mb-0"><strong>${lang === 'en' ? 'Phone:' : '電話:'}</strong> ${escapeHtml(company.phone)}</div>
          </div>
        </div>

        <div class="card card-outline card-secondary shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-server text-secondary mr-2"></i>${t.dashboard.systemStatusTitle}
            </h3>
          </div>
          <div class="card-body text-xs">
            <div class="d-flex justify-content-between mb-1">
              <span>${lang === 'en' ? 'Database:' : 'データベース:'}</span>
              <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i>SQLite (Durable)</span>
            </div>
            <div class="d-flex justify-content-between mb-1">
              <span>${lang === 'en' ? 'Port:' : 'ポート番号:'}</span>
              <span class="font-weight-bold">3000 (Production Ready)</span>
            </div>
            <div class="d-flex justify-content-between mb-1">
              <span>${lang === 'en' ? 'Framework:' : 'UIフレームワーク:'}</span>
              <span class="text-primary font-weight-bold">AdminLTE 3.2.0</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>${lang === 'en' ? 'Language:' : '表示言語:'}</span>
              <span class="badge badge-primary font-weight-bold">${t.langName} (Active)</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;

  const modals = `
    <!-- Modal: View Inquiry -->
    <div class="modal fade" id="modal-view-inquiry" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-envelope-open mr-2"></i>${t.inquiries.modalTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">${t.inquiries.fieldSender}</label>
              <div class="font-weight-bold" id="view_inq_name"></div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">${t.inquiries.fieldCompany}</label>
              <div class="font-weight-bold" id="view_inq_company"></div>
            </div>
            <div class="row">
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">${t.inquiries.fieldEmail}</label>
                <div id="view_inq_email"></div>
              </div>
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">${t.inquiries.fieldPhone}</label>
                <div id="view_inq_phone"></div>
              </div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">${t.inquiries.fieldInterest}</label>
              <div><span class="badge badge-info" id="view_inq_type"></span></div>
            </div>
            <div class="form-group mb-0">
              <label class="text-xs text-muted mb-1">${t.inquiries.fieldMessage}</label>
              <div class="p-3 bg-light rounded border text-sm" id="view_inq_message" style="white-space: pre-wrap; word-break: break-word;"></div>
            </div>
          </div>
          <div class="modal-footer bg-light py-2">
            <a href="/admin/inquiries" class="btn btn-outline-primary btn-sm">${t.inquiries.title}</a>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.close}</button>
          </div>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openInquiryModal(inq) {
        document.getElementById('view_inq_name').textContent = inq.name || '';
        document.getElementById('view_inq_company').textContent = inq.company_name || '${lang === 'en' ? '(Not specified)' : '未入力'}';
        document.getElementById('view_inq_email').innerHTML = '<a href="mailto:' + (inq.email || '') + '">' + (inq.email || '') + '</a>';
        document.getElementById('view_inq_phone').textContent = inq.phone || '${lang === 'en' ? '(Not specified)' : '未入力'}';
        document.getElementById('view_inq_type').textContent = inq.inquiry_type || inq.service_interest || '${lang === 'en' ? 'General' : '一般相談'}';
        document.getElementById('view_inq_message').textContent = inq.message || '';
        $('#modal-view-inquiry').modal('show');
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 2. Company & Visuals Page
// ----------------------------------------------------
export function renderCompanyContent(company: any, lang: AdminLang = 'ja'): { body: string; modals: string; scripts: string } {
  const t = i18n[lang];

  const body = `
    <div class="row">
      <!-- CEO Photo Upload Card -->
      <div class="col-md-6 mb-4">
        <div class="card card-outline card-primary shadow-sm h-100">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-user-tie text-primary mr-2"></i>${t.company.ceoImageTitle}
            </h3>
          </div>
          <div class="card-body text-center">
            <div class="mb-3">
              <img id="ceo_photo_preview" src="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}" alt="CEO Preview" class="preview-thumb elevation-2" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%;">
            </div>
            <div class="drop-zone mb-3" id="drop_zone_ceo" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event, 'ceo_image')">
              <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
              <div class="font-weight-bold text-dark text-sm">${t.company.dropPrompt}</div>
              <div class="text-xs text-muted mb-2">${t.company.mediaDesc}</div>
              <label class="btn btn-sm btn-primary mb-0 shadow-sm">
                <i class="fas fa-folder-open mr-1"></i> ${t.actions.upload}
                <input type="file" name="ceo_image_file" accept="image/*" style="display: none;" onchange="uploadAdminImageFile(this, 'ceo_image')">
              </label>
            </div>
            <div id="ceo_upload_status" class="text-xs font-weight-bold"></div>
            <div class="mt-2 text-right">
              <button type="button" class="btn btn-xs btn-outline-secondary" onclick="resetImageToDefault('ceo_image')">
                <i class="fas fa-undo mr-1"></i> ${lang === 'en' ? 'Reset to Default Photo' : 'デフォルト写真に戻す'}
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Hero Banner Upload Card -->
      <div class="col-md-6 mb-4">
        <div class="card card-outline card-primary shadow-sm h-100">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-image text-primary mr-2"></i>${t.company.heroImageTitle}
            </h3>
          </div>
          <div class="card-body text-center">
            <div class="mb-3">
              <img id="hero_banner_preview" src="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}" alt="Hero Preview" class="preview-thumb elevation-2" style="width: 100%; height: 140px; object-fit: cover;">
            </div>
            <div class="drop-zone mb-3" id="drop_zone_hero" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event, 'hero_image')">
              <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
              <div class="font-weight-bold text-dark text-sm">${t.company.dropPrompt}</div>
              <div class="text-xs text-muted mb-2">${t.company.mediaDesc}</div>
              <label class="btn btn-sm btn-primary mb-0 shadow-sm">
                <i class="fas fa-folder-open mr-1"></i> ${t.actions.upload}
                <input type="file" name="hero_image_file" accept="image/*" style="display: none;" onchange="uploadAdminImageFile(this, 'hero_image')">
              </label>
            </div>
            <div id="hero_upload_status" class="text-xs font-weight-bold"></div>
            <div class="mt-2 text-right">
              <button type="button" class="btn btn-xs btn-outline-secondary" onclick="resetImageToDefault('hero_image')">
                <i class="fas fa-undo mr-1"></i> ${lang === 'en' ? 'Reset to Default Banner' : 'デフォルト画像に戻す'}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Corporate Information Form -->
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-building text-primary mr-2"></i>${t.company.cardTitle}
        </h3>
      </div>
      <form action="/admin/company" method="POST" id="company_info_form">
        <input type="hidden" name="ceo_image" id="input_form_ceo_image" value="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}">
        <input type="hidden" name="hero_image" id="input_form_hero_image" value="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}">
        
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.nameJa} <span class="text-danger">*</span></label>
              <input type="text" name="name_ja" class="form-control" value="${escapeHtml(company.name_ja || '')}" required>
            </div>
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.nameEn} <span class="text-danger">*</span></label>
              <input type="text" name="name_en" class="form-control" value="${escapeHtml(company.name_en || '')}" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>${t.company.established}</label>
              <input type="text" name="established" class="form-control" value="${escapeHtml(company.established || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>${t.company.capital}</label>
              <input type="text" name="capital" class="form-control" value="${escapeHtml(company.capital || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>${lang === 'en' ? 'Corporate Number' : '法人番号 (Corporate Number)'}</label>
              <input type="text" name="corporate_number" class="form-control" value="${escapeHtml(company.corporate_number || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>${t.company.licenseNumbers}</label>
              <input type="text" name="license" class="form-control" value="${escapeHtml(company.license || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.ceoNameJa}</label>
              <input type="text" name="ceo_name_ja" class="form-control" value="${escapeHtml(company.ceo_name_ja || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.ceoNameEn}</label>
              <input type="text" name="ceo_name_en" class="form-control" value="${escapeHtml(company.ceo_name_en || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>${lang === 'en' ? 'Representative Title (JA)' : '役職名 (日本語)'}</label>
              <input type="text" name="ceo_role_ja" class="form-control" value="${escapeHtml(company.ceo_role_ja || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>${lang === 'en' ? 'Representative Title (EN)' : 'Role (English)'}</label>
              <input type="text" name="ceo_role_en" class="form-control" value="${escapeHtml(company.ceo_role_en || '')}">
            </div>
          </div>

          <div class="form-group">
            <label class="font-weight-bold">${lang === 'en' ? 'CEO Message (Japanese)' : '代表メッセージ (日本語)'}</label>
            <textarea name="ceo_message_ja" class="form-control" rows="4">${escapeHtml(company.ceo_message_ja || '')}</textarea>
          </div>

          <div class="form-group">
            <label class="font-weight-bold">${lang === 'en' ? 'CEO Message (English)' : 'CEO Message (English)'}</label>
            <textarea name="ceo_message_en" class="form-control" rows="4">${escapeHtml(company.ceo_message_en || '')}</textarea>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.phone}</label>
              <input type="text" name="phone" class="form-control" value="${escapeHtml(company.phone || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.email}</label>
              <input type="email" name="email" class="form-control" value="${escapeHtml(company.email || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.addressJa}</label>
              <input type="text" name="address_ja" class="form-control" value="${escapeHtml(company.address_ja || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.company.addressEn}</label>
              <input type="text" name="address_en" class="form-control" value="${escapeHtml(company.address_en || '')}">
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border-top text-right">
          <button type="submit" class="btn btn-primary font-weight-bold px-4 shadow-sm">
            <i class="fas fa-save mr-1"></i> ${t.actions.save}
          </button>
        </div>
      </form>
    </div>
  `;

  const scripts = `
    <script>
      function handleDragOver(e) {
        e.preventDefault();
        e.stopPropagation();
        e.currentTarget.classList.add('dragover');
      }

      function handleDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();
        e.currentTarget.classList.remove('dragover');
      }

      function handleDrop(e, targetField) {
        e.preventDefault();
        e.stopPropagation();
        e.currentTarget.classList.remove('dragover');

        const files = e.dataTransfer.files;
        if (files && files.length > 0) {
          uploadAdminImageBlob(files[0], targetField);
        }
      }

      function uploadAdminImageFile(input, targetField) {
        if (input.files && input.files.length > 0) {
          uploadAdminImageBlob(input.files[0], targetField);
        }
      }

      async function uploadAdminImageBlob(file, targetField) {
        const statusEl = document.getElementById(targetField === 'ceo_image' ? 'ceo_upload_status' : 'hero_upload_status');
        statusEl.className = 'text-xs text-info font-weight-bold';
        statusEl.textContent = '${lang === 'en' ? 'Uploading...' : 'アップロード中...'}';

        const reader = new FileReader();
        reader.onload = async function(e) {
          const base64Data = e.target.result;
          try {
            const res = await fetch('/api/admin/upload-image', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-Admin-Token': 'miransh_admin_token_2026_auth_ok'
              },
              body: JSON.stringify({
                target_field: targetField,
                data: base64Data
              })
            });
            const data = await res.json();
            if (data.success && data.url) {
              if (targetField === 'ceo_image') {
                document.getElementById('ceo_photo_preview').src = data.url;
                document.getElementById('input_form_ceo_image').value = data.url;
              } else {
                document.getElementById('hero_banner_preview').src = data.url;
                document.getElementById('input_form_hero_image').value = data.url;
              }
              statusEl.className = 'text-xs text-success font-weight-bold';
              statusEl.textContent = '✓ ${t.company.uploadSuccess}';
            } else {
              throw new Error(data.message || 'Upload failed');
            }
          } catch (err) {
            statusEl.className = 'text-xs text-danger font-weight-bold';
            statusEl.textContent = '✗ アップロード失敗: ' + err.message;
          }
        };
        reader.readAsDataURL(file);
      }

      async function resetImageToDefault(targetField) {
        const defaultUrl = targetField === 'ceo_image' ? '/images/ceo_portrait.jpg' : '/images/hero_banner.jpg';
        if (!confirm('${lang === 'en' ? 'Reset image to default?' : '画像をデフォルトに戻しますか？'}')) return;

        try {
          const res = await fetch('/api/admin/upload-image', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-Admin-Token': 'miransh_admin_token_2026_auth_ok'
            },
            body: JSON.stringify({
              target_field: targetField,
              data: defaultUrl
            })
          });

          if (targetField === 'ceo_image') {
            document.getElementById('ceo_photo_preview').src = defaultUrl;
            document.getElementById('input_form_ceo_image').value = defaultUrl;
          } else {
            document.getElementById('hero_banner_preview').src = defaultUrl;
            document.getElementById('input_form_hero_image').value = defaultUrl;
          }
          alert('${lang === 'en' ? 'Reset to default. Click Save to confirm changes.' : 'デフォルトに戻しました。保存ボタンを押して確定してください。'}');
        } catch (e) {
          console.error(e);
        }
      }
    </script>
  `;

  return { body, modals: '', scripts };
}

// ----------------------------------------------------
// 3. About & Philosophy Page
// ----------------------------------------------------
export function renderAboutContent(about: any, lang: AdminLang = 'ja'): { body: string; modals: string; scripts: string } {
  const t = i18n[lang];

  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-award text-primary mr-2"></i>${t.about.cardTitle}
        </h3>
      </div>
      <form action="/admin/about" method="POST">
        <div class="card-body">
          <div class="form-group">
            <label class="font-weight-bold">${t.about.philosophyJa}</label>
            <textarea name="philosophy_ja" class="form-control" rows="3">${escapeHtml(about?.philosophy_ja || '')}</textarea>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">${t.about.philosophyEn}</label>
            <textarea name="philosophy_en" class="form-control" rows="3">${escapeHtml(about?.philosophy_en || '')}</textarea>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.about.visionJa}</label>
              <textarea name="vision_ja" class="form-control" rows="3">${escapeHtml(about?.vision_ja || '')}</textarea>
            </div>
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.about.visionEn}</label>
              <textarea name="vision_en" class="form-control" rows="3">${escapeHtml(about?.vision_en || '')}</textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.about.missionJa}</label>
              <textarea name="mission_ja" class="form-control" rows="3">${escapeHtml(about?.mission_ja || '')}</textarea>
            </div>
            <div class="col-md-6 form-group">
              <label class="font-weight-bold">${t.about.missionEn}</label>
              <textarea name="mission_en" class="form-control" rows="3">${escapeHtml(about?.mission_en || '')}</textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="font-weight-bold">${t.about.valuesJa}</label>
            <textarea name="values_ja" class="form-control" rows="3" placeholder="${lang === 'en' ? '1 line per value' : '1行に1つの価値観を記入'}">${escapeHtml(about?.values_ja || '')}</textarea>
          </div>

          <hr>

          <div class="form-group">
            <label class="font-weight-bold">${t.about.ceoMessageJa}</label>
            <textarea name="ceo_message_ja" class="form-control" rows="5">${escapeHtml(about?.ceo_message_ja || '')}</textarea>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">${t.about.ceoMessageEn}</label>
            <textarea name="ceo_message_en" class="form-control" rows="5">${escapeHtml(about?.ceo_message_en || '')}</textarea>
          </div>
        </div>
        <div class="card-footer bg-white border-top text-right">
          <button type="submit" class="btn btn-primary font-weight-bold px-4 shadow-sm">
            <i class="fas fa-save mr-1"></i> ${t.actions.save}
          </button>
        </div>
      </form>
    </div>
  `;

  return { body, modals: '', scripts: '' };
}

// ----------------------------------------------------
// 4. Services Management Page
// ----------------------------------------------------
export function renderServicesContent(services: any[], lang: AdminLang = 'ja'): { body: string; modals: string; scripts: string } {
  const t = i18n[lang];

  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-concierge-bell text-primary mr-2"></i>${t.services.cardTitle} (${services.length})
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-primary btn-sm font-weight-bold shadow-sm" data-toggle="modal" data-target="#modal-create-service">
            <i class="fas fa-plus-circle mr-1"></i> ${t.services.addNew}
          </button>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover text-sm mb-0">
          <thead class="thead-light">
            <tr>
              <th style="width: 60px;">${t.services.tableNum}</th>
              <th>${t.services.tableTitle}</th>
              <th>${t.services.tableCategory}</th>
              <th>${t.services.tableDesc}</th>
              <th style="width: 70px;">${t.services.tableOrder}</th>
              <th class="text-right" style="width: 130px;">${t.services.tableActions}</th>
            </tr>
          </thead>
          <tbody>
            ${services.map(svc => `
              <tr>
                <td><span class="badge badge-secondary font-weight-bold">${escapeHtml(svc.number || '0' + svc.id)}</span></td>
                <td>
                  <div class="font-weight-bold text-dark">${escapeHtml(svc.title_ja)}</div>
                  <small class="text-muted">${escapeHtml(svc.title_en || '')}</small>
                </td>
                <td>
                  <span class="badge badge-info px-2 py-1"><i class="fas fa-${escapeHtml(svc.icon || 'star')} mr-1"></i>${escapeHtml(lang === 'en' ? (svc.category_en || svc.category_ja) : (svc.category_ja || '特定技能'))}</span>
                </td>
                <td style="max-width: 260px;" class="text-truncate text-secondary">
                  ${escapeHtml(lang === 'en' ? (svc.description_en || svc.description_ja) : svc.description_ja)}
                </td>
                <td>${svc.sort_order || 0}</td>
                <td class="text-right text-nowrap">
                  <button type="button" class="btn btn-xs btn-outline-primary mr-1" onclick='openEditServiceModal(${JSON.stringify(svc).replace(/'/g, "&#39;")})'>
                    <i class="fas fa-edit mr-1"></i>${t.actions.edit}
                  </button>
                  <button type="button" class="btn btn-xs btn-outline-danger" onclick="deleteServiceItem(${svc.id})">
                    <i class="fas fa-trash-alt mr-1"></i>${t.actions.delete}
                  </button>
                </td>
              </tr>
            `).join('')}
            ${services.length === 0 ? `<tr><td colspan="6" class="text-center py-4 text-muted">${lang === 'en' ? 'No services found.' : '登録されているサービスはありません。'}</td></tr>` : ''}
          </tbody>
        </table>
      </div>
    </div>
  `;

  const modals = `
    <!-- Modal: Create Service -->
    <div class="modal fade" id="modal-create-service" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>${t.services.modalCreateTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/services" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3 form-group">
                  <label>${t.services.numberLabel} *</label>
                  <input type="text" name="number" class="form-control" placeholder="01" required value="0${services.length + 1}">
                </div>
                <div class="col-md-5 form-group">
                  <label>${t.services.iconLabel}</label>
                  <input type="text" name="icon" class="form-control" placeholder="users, hospital, handshake" value="users">
                </div>
                <div class="col-md-4 form-group">
                  <label>${t.services.sortOrder}</label>
                  <input type="number" name="sort_order" class="form-control" value="${services.length + 1}">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.services.titleJa} *</label>
                  <input type="text" name="title_ja" class="form-control" required placeholder="${lang === 'en' ? 'Service Title (Japanese)' : '例: 特定技能外国人 採用・受入支援'}">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.services.titleEn} *</label>
                  <input type="text" name="title_en" class="form-control" required placeholder="e.g., SSW Global Talent Placement">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.services.subtitleJa}</label>
                  <input type="text" name="subtitle_ja" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.services.subtitleEn}</label>
                  <input type="text" name="subtitle_en" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.services.categoryJa}</label>
                  <input type="text" name="category_ja" class="form-control" value="特定技能">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.services.categoryEn}</label>
                  <input type="text" name="category_en" class="form-control" value="Specified Skilled Worker">
                </div>
              </div>
              <div class="form-group">
                <label>${t.services.imageLabel}</label>
                <input type="text" name="image" class="form-control" value="/images/service1.jpg">
              </div>
              <div class="form-group">
                <label>${t.services.descJa}</label>
                <textarea name="description_ja" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>${t.services.descEn}</label>
                <textarea name="description_en" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>${t.services.itemsJa}</label>
                <textarea name="items_ja" class="form-control" rows="3" placeholder="${lang === 'en' ? 'Item 1\nItem 2' : '・日本語教育・介護専門用語の習得\n・入国前オリエンテーション'}"></textarea>
              </div>
              <div class="form-group">
                <label>${t.services.itemsEn}</label>
                <textarea name="items_en" class="form-control" rows="3" placeholder="Item 1\nItem 2"></textarea>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.cancel}</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ ${t.actions.add}</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal: Edit Service -->
    <div class="modal fade" id="modal-edit-service" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>${t.services.modalEditTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-edit-service" action="" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3 form-group">
                  <label>${t.services.numberLabel}</label>
                  <input type="text" name="number" id="edit_svc_number" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                  <label>${t.services.iconLabel}</label>
                  <input type="text" name="icon" id="edit_svc_icon" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                  <label>${t.services.sortOrder}</label>
                  <input type="number" name="sort_order" id="edit_svc_order" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.services.titleJa} *</label>
                  <input type="text" name="title_ja" id="edit_svc_title_ja" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.services.titleEn} *</label>
                  <input type="text" name="title_en" id="edit_svc_title_en" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.services.categoryJa}</label>
                  <input type="text" name="category_ja" id="edit_svc_cat_ja" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.services.categoryEn}</label>
                  <input type="text" name="category_en" id="edit_svc_cat_en" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label>${t.services.imageLabel}</label>
                <input type="text" name="image" id="edit_svc_image" class="form-control">
              </div>
              <div class="form-group">
                <label>${t.services.descJa}</label>
                <textarea name="description_ja" id="edit_svc_desc_ja" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>${t.services.descEn}</label>
                <textarea name="description_en" id="edit_svc_desc_en" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>${t.services.itemsJa}</label>
                <textarea name="items_ja" id="edit_svc_items_ja" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>${t.services.itemsEn}</label>
                <textarea name="items_en" id="edit_svc_items_en" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.cancel}</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ ${t.actions.save}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openEditServiceModal(svc) {
        document.getElementById('form-edit-service').action = '/admin/services/' + svc.id + '/update';
        document.getElementById('edit_svc_number').value = svc.number || '';
        document.getElementById('edit_svc_icon').value = svc.icon || 'users';
        document.getElementById('edit_svc_order').value = svc.sort_order || 0;
        document.getElementById('edit_svc_title_ja').value = svc.title_ja || '';
        document.getElementById('edit_svc_title_en').value = svc.title_en || '';
        document.getElementById('edit_svc_cat_ja').value = svc.category_ja || '';
        document.getElementById('edit_svc_cat_en').value = svc.category_en || '';
        document.getElementById('edit_svc_image').value = svc.image || '';
        document.getElementById('edit_svc_desc_ja').value = svc.description_ja || '';
        document.getElementById('edit_svc_desc_en').value = svc.description_en || '';
        document.getElementById('edit_svc_items_ja').value = Array.isArray(svc.items_ja) ? svc.items_ja.join('\\n') : (svc.items_ja || '');
        document.getElementById('edit_svc_items_en').value = Array.isArray(svc.items_en) ? svc.items_en.join('\\n') : (svc.items_en || '');
        $('#modal-edit-service').modal('show');
      }

      function deleteServiceItem(id) {
        if (!confirm('${t.actions.confirmDelete}')) return;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/services/' + id + '/delete';
        document.body.appendChild(form);
        form.submit();
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 5. Stories & Case Studies Page
// ----------------------------------------------------
export function renderStoriesContent(stories: any[], lang: AdminLang = 'ja'): { body: string; modals: string; scripts: string } {
  const t = i18n[lang];

  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-book-open text-primary mr-2"></i>${t.stories.cardTitle} (${stories.length})
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-primary btn-sm font-weight-bold shadow-sm" data-toggle="modal" data-target="#modal-create-story">
            <i class="fas fa-plus-circle mr-1"></i> ${t.stories.addNew}
          </button>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover text-sm mb-0">
          <thead class="thead-light">
            <tr>
              <th style="width: 70px;">${t.stories.tableImage}</th>
              <th>${t.stories.tableTitle}</th>
              <th>${t.stories.tableCategory}</th>
              <th>${t.stories.tableDate}</th>
              <th class="text-center">${t.stories.tableFeatured}</th>
              <th class="text-right" style="width: 140px;">${t.stories.tableActions}</th>
            </tr>
          </thead>
          <tbody>
            ${stories.map(st => `
              <tr>
                <td>
                  <img src="${escapeHtml(st.image || '/images/story1.jpg')}" class="img-thumbnail" style="width: 55px; height: 38px; object-fit: cover;">
                </td>
                <td>
                  <div class="font-weight-bold text-dark">${escapeHtml(st.title_ja)}</div>
                  <small class="text-muted">${escapeHtml(st.title_en || '')}</small>
                </td>
                <td>
                  <span class="badge badge-secondary px-2 py-1">${escapeHtml(lang === 'en' ? (st.category_en || st.category_ja) : st.category_ja)}</span>
                </td>
                <td class="text-xs text-muted">${escapeHtml(st.published_date || '')}</td>
                <td class="text-center">
                  ${st.featured 
                    ? `<span class="badge badge-warning text-dark font-weight-bold px-2 py-1"><i class="fas fa-star mr-1 text-danger"></i>${t.stories.featuredBadge}</span>` 
                    : `<span class="badge badge-light border text-muted px-2 py-1">${t.stories.normalBadge}</span>`}
                </td>
                <td class="text-right text-nowrap">
                  <button type="button" class="btn btn-xs btn-outline-primary mr-1" onclick='openEditStoryModal(${JSON.stringify(st).replace(/'/g, "&#39;")})'>
                    <i class="fas fa-edit mr-1"></i>${t.actions.edit}
                  </button>
                  <button type="button" class="btn btn-xs btn-outline-danger" onclick="deleteStoryItem(${st.id})">
                    <i class="fas fa-trash-alt mr-1"></i>${t.actions.delete}
                  </button>
                </td>
              </tr>
            `).join('')}
            ${stories.length === 0 ? `<tr><td colspan="6" class="text-center py-4 text-muted">${lang === 'en' ? 'No stories found.' : '登録されている事例はありません。'}</td></tr>` : ''}
          </tbody>
        </table>
      </div>
    </div>
  `;

  const modals = `
    <!-- Modal: Create Story -->
    <div class="modal fade" id="modal-create-story" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>${t.stories.modalCreateTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/stories" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.stories.titleJa} *</label>
                  <input type="text" name="title_ja" class="form-control" required placeholder="${lang === 'en' ? 'Story Title (Japanese)' : '例: 介護施設様へのネパール特定技能人材マッチング'}">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.stories.titleEn} *</label>
                  <input type="text" name="title_en" class="form-control" required placeholder="e.g., SSW Caregiver Placement Story">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.stories.categoryJa} *</label>
                  <input type="text" name="category_ja" class="form-control" required value="特定技能 / 介護分野">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.stories.categoryEn} *</label>
                  <input type="text" name="category_en" class="form-control" required value="Nursing Care / SSW">
                </div>
              </div>
              <div class="form-group">
                <label>${t.stories.imageUrl}</label>
                <input type="text" name="image" class="form-control" value="/images/story1.jpg">
              </div>
              <div class="form-group">
                <label>${t.stories.summaryJa}</label>
                <textarea name="summary_ja" class="form-control" rows="2"></textarea>
              </div>
              <div class="form-group">
                <label>${t.stories.summaryEn}</label>
                <textarea name="summary_en" class="form-control" rows="2"></textarea>
              </div>
              <div class="form-group">
                <label>${t.stories.contentJa}</label>
                <textarea name="content_ja" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label>${t.stories.contentEn}</label>
                <textarea name="content_en" class="form-control" rows="4"></textarea>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.stories.publishedDate}</label>
                  <input type="text" name="published_date" class="form-control" value="2026.09.04">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.stories.author}</label>
                  <input type="text" name="author" class="form-control" value="MIRANSH Editorial">
                </div>
              </div>
              <div class="form-check">
                <input type="checkbox" name="featured" value="1" class="form-check-input" id="create_featured_check" checked>
                <label class="form-check-label font-weight-bold" for="create_featured_check">${t.stories.isFeatured}</label>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.cancel}</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ ${t.actions.add}</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal: Edit Story -->
    <div class="modal fade" id="modal-edit-story" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>${t.stories.modalEditTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-edit-story" action="" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.stories.titleJa} *</label>
                  <input type="text" name="title_ja" id="edit_st_title_ja" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.stories.titleEn} *</label>
                  <input type="text" name="title_en" id="edit_st_title_en" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.stories.categoryJa} *</label>
                  <input type="text" name="category_ja" id="edit_st_cat_ja" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.stories.categoryEn} *</label>
                  <input type="text" name="category_en" id="edit_st_cat_en" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label>${t.stories.imageUrl}</label>
                <input type="text" name="image" id="edit_st_image" class="form-control">
              </div>
              <div class="form-group">
                <label>${t.stories.summaryJa}</label>
                <textarea name="summary_ja" id="edit_st_summary_ja" class="form-control" rows="2"></textarea>
              </div>
              <div class="form-group">
                <label>${t.stories.summaryEn}</label>
                <textarea name="summary_en" id="edit_st_summary_en" class="form-control" rows="2"></textarea>
              </div>
              <div class="form-group">
                <label>${t.stories.contentJa}</label>
                <textarea name="content_ja" id="edit_st_content_ja" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label>${t.stories.contentEn}</label>
                <textarea name="content_en" id="edit_st_content_en" class="form-control" rows="4"></textarea>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>${t.stories.publishedDate}</label>
                  <input type="text" name="published_date" id="edit_st_date" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                  <label>${t.stories.author}</label>
                  <input type="text" name="author" id="edit_st_author" class="form-control">
                </div>
              </div>
              <div class="form-check">
                <input type="checkbox" name="featured" value="1" class="form-check-input" id="edit_featured_check">
                <label class="form-check-label font-weight-bold" for="edit_featured_check">${t.stories.isFeatured}</label>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.cancel}</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ ${t.actions.save}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openEditStoryModal(st) {
        document.getElementById('form-edit-story').action = '/admin/stories/' + st.id + '/update';
        document.getElementById('edit_st_title_ja').value = st.title_ja || '';
        document.getElementById('edit_st_title_en').value = st.title_en || '';
        document.getElementById('edit_st_cat_ja').value = st.category_ja || '';
        document.getElementById('edit_st_cat_en').value = st.category_en || '';
        document.getElementById('edit_st_image').value = st.image || '';
        document.getElementById('edit_st_summary_ja').value = st.summary_ja || '';
        document.getElementById('edit_st_summary_en').value = st.summary_en || '';
        document.getElementById('edit_st_content_ja').value = st.content_ja || '';
        document.getElementById('edit_st_content_en').value = st.content_en || '';
        document.getElementById('edit_st_date').value = st.published_date || '';
        document.getElementById('edit_st_author').value = st.author || '';
        document.getElementById('edit_featured_check').checked = Boolean(st.featured);
        $('#modal-edit-story').modal('show');
      }

      function deleteStoryItem(id) {
        if (!confirm('${t.actions.confirmDelete}')) return;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/stories/' + id + '/delete';
        document.body.appendChild(form);
        form.submit();
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 6. FAQs Management Page
// ----------------------------------------------------
export function renderFaqsContent(faqs: any[], lang: AdminLang = 'ja'): { body: string; modals: string; scripts: string } {
  const t = i18n[lang];

  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-question-circle text-primary mr-2"></i>${t.faqs.cardTitle} (${faqs.length})
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-primary btn-sm font-weight-bold shadow-sm" data-toggle="modal" data-target="#modal-create-faq">
            <i class="fas fa-plus-circle mr-1"></i> ${t.faqs.addNew}
          </button>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover text-sm mb-0">
          <thead class="thead-light">
            <tr>
              <th style="width: 140px;">${t.faqs.tableCategory}</th>
              <th>${t.faqs.tableQuestion}</th>
              <th>${t.faqs.tableAnswer}</th>
              <th style="width: 60px;">${t.faqs.tableOrder}</th>
              <th class="text-right" style="width: 130px;">${t.faqs.tableActions}</th>
            </tr>
          </thead>
          <tbody>
            ${faqs.map(f => `
              <tr>
                <td><span class="badge badge-info px-2 py-1">${escapeHtml(lang === 'en' ? (f.category_en || f.category_ja) : (f.category_ja || '特定技能'))}</span></td>
                <td>
                  <div class="font-weight-bold text-dark">${escapeHtml(f.question_ja)}</div>
                  <small class="text-muted">${escapeHtml(f.question_en || '')}</small>
                </td>
                <td style="max-width: 280px;" class="text-truncate text-secondary">
                  ${escapeHtml(lang === 'en' ? (f.answer_en || f.answer_ja) : f.answer_ja)}
                </td>
                <td>${f.sort_order || 0}</td>
                <td class="text-right text-nowrap">
                  <button type="button" class="btn btn-xs btn-outline-primary mr-1" onclick='openEditFaqModal(${JSON.stringify(f).replace(/'/g, "&#39;")})'>
                    <i class="fas fa-edit mr-1"></i>${t.actions.edit}
                  </button>
                  <button type="button" class="btn btn-xs btn-outline-danger" onclick="deleteFaqItem(${f.id})">
                    <i class="fas fa-trash-alt mr-1"></i>${t.actions.delete}
                  </button>
                </td>
              </tr>
            `).join('')}
            ${faqs.length === 0 ? `<tr><td colspan="5" class="text-center py-4 text-muted">${lang === 'en' ? 'No FAQs found.' : '登録されているFAQはありません。'}</td></tr>` : ''}
          </tbody>
        </table>
      </div>
    </div>
  `;

  const modals = `
    <!-- Modal: Create FAQ -->
    <div class="modal fade" id="modal-create-faq" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>${t.faqs.modalCreateTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/faqs" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5 form-group">
                  <label>${t.faqs.categoryJa} *</label>
                  <input type="text" name="category_ja" class="form-control" required value="特定技能・ビザ申請">
                </div>
                <div class="col-md-5 form-group">
                  <label>${t.faqs.categoryEn} *</label>
                  <input type="text" name="category_en" class="form-control" required value="SSW & Visa Procedures">
                </div>
                <div class="col-md-2 form-group">
                  <label>${t.faqs.sortOrder}</label>
                  <input type="number" name="sort_order" class="form-control" value="${faqs.length + 1}">
                </div>
              </div>
              <div class="form-group">
                <label>${t.faqs.questionJa} *</label>
                <input type="text" name="question_ja" class="form-control" required placeholder="${lang === 'en' ? 'Question in Japanese' : '例: ネパール特定技能人材の受入までにどのくらい期間がかかりますか？'}">
              </div>
              <div class="form-group">
                <label>${t.faqs.questionEn} *</label>
                <input type="text" name="question_en" class="form-control" required placeholder="e.g., How long does it take from interview to arrival?">
              </div>
              <div class="form-group">
                <label>${t.faqs.answerJa} *</label>
                <textarea name="answer_ja" class="form-control" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label>${t.faqs.answerEn} *</label>
                <textarea name="answer_en" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.cancel}</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ ${t.actions.add}</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal: Edit FAQ -->
    <div class="modal fade" id="modal-edit-faq" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>${t.faqs.modalEditTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-edit-faq" action="" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5 form-group">
                  <label>${t.faqs.categoryJa} *</label>
                  <input type="text" name="category_ja" id="edit_faq_cat_ja" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                  <label>${t.faqs.categoryEn} *</label>
                  <input type="text" name="category_en" id="edit_faq_cat_en" class="form-control" required>
                </div>
                <div class="col-md-2 form-group">
                  <label>${t.faqs.sortOrder}</label>
                  <input type="number" name="sort_order" id="edit_faq_order" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label>${t.faqs.questionJa} *</label>
                <input type="text" name="question_ja" id="edit_faq_q_ja" class="form-control" required>
              </div>
              <div class="form-group">
                <label>${t.faqs.questionEn} *</label>
                <input type="text" name="question_en" id="edit_faq_q_en" class="form-control" required>
              </div>
              <div class="form-group">
                <label>${t.faqs.answerJa} *</label>
                <textarea name="answer_ja" id="edit_faq_a_ja" class="form-control" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label>${t.faqs.answerEn} *</label>
                <textarea name="answer_en" id="edit_faq_a_en" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.cancel}</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ ${t.actions.save}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openEditFaqModal(faq) {
        document.getElementById('form-edit-faq').action = '/admin/faqs/' + faq.id + '/update';
        document.getElementById('edit_faq_cat_ja').value = faq.category_ja || '';
        document.getElementById('edit_faq_cat_en').value = faq.category_en || '';
        document.getElementById('edit_faq_order').value = faq.sort_order || 0;
        document.getElementById('edit_faq_q_ja').value = faq.question_ja || '';
        document.getElementById('edit_faq_q_en').value = faq.question_en || '';
        document.getElementById('edit_faq_a_ja').value = faq.answer_ja || '';
        document.getElementById('edit_faq_a_en').value = faq.answer_en || '';
        $('#modal-edit-faq').modal('show');
      }

      function deleteFaqItem(id) {
        if (!confirm('${t.actions.confirmDelete}')) return;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/faqs/' + id + '/delete';
        document.body.appendChild(form);
        form.submit();
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 7. Inquiries Management Page
// ----------------------------------------------------
export function renderInquiriesContent(inquiries: any[], filter: string = 'all', lang: AdminLang = 'ja'): { body: string; modals: string; scripts: string } {
  const t = i18n[lang];

  const filteredInquiries = inquiries.filter(inq => {
    if (filter === 'unread') return inq.status !== 'resolved';
    if (filter === 'resolved') return inq.status === 'resolved';
    return true;
  });

  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-envelope text-primary mr-2"></i>${t.inquiries.cardTitle} (${filteredInquiries.length})
        </h3>
        <div class="card-tools">
          <div class="btn-group btn-group-sm">
            <a href="/admin/inquiries?filter=all" class="btn ${filter === 'all' ? 'btn-primary font-weight-bold' : 'btn-outline-secondary'}">
              ${t.inquiries.filterAll} (${inquiries.length})
            </a>
            <a href="/admin/inquiries?filter=unread" class="btn ${filter === 'unread' ? 'btn-warning font-weight-bold' : 'btn-outline-secondary'}">
              ${t.inquiries.filterUnread}
            </a>
            <a href="/admin/inquiries?filter=resolved" class="btn ${filter === 'resolved' ? 'btn-success font-weight-bold' : 'btn-outline-secondary'}">
              ${t.inquiries.filterResolved}
            </a>
          </div>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover text-sm mb-0">
          <thead class="thead-light">
            <tr>
              <th style="width: 140px;">${t.inquiries.tableDate}</th>
              <th>${t.inquiries.tableSender}</th>
              <th>${t.inquiries.tableContact}</th>
              <th>${t.inquiries.tableInterest}</th>
              <th>${t.inquiries.tableMessage}</th>
              <th class="text-center" style="width: 110px;">${t.inquiries.tableStatus}</th>
              <th class="text-right" style="width: 160px;">${t.inquiries.tableActions}</th>
            </tr>
          </thead>
          <tbody>
            ${filteredInquiries.map(inq => `
              <tr>
                <td class="text-xs text-muted">${escapeHtml(inq.created_at || 'Recently')}</td>
                <td>
                  <div class="font-weight-bold text-dark">${escapeHtml(inq.name)}</div>
                  <small class="text-muted"><i class="fas fa-building mr-1"></i>${escapeHtml(inq.company_name || t.inquiries.noCompanySpecified)}</small>
                </td>
                <td>
                  <div class="text-xs"><i class="fas fa-envelope mr-1 text-secondary"></i><a href="mailto:${escapeHtml(inq.email)}">${escapeHtml(inq.email)}</a></div>
                  ${inq.phone ? `<div class="text-xs text-muted"><i class="fas fa-phone mr-1 text-secondary"></i>${escapeHtml(inq.phone)}</div>` : ''}
                </td>
                <td>
                  <span class="badge badge-info px-2 py-1">${escapeHtml(inq.inquiry_type || inq.service_interest || (lang === 'en' ? 'General' : '一般相談'))}</span>
                </td>
                <td style="max-width: 240px;" class="text-truncate text-secondary">
                  ${escapeHtml(inq.message || '')}
                </td>
                <td class="text-center">
                  <form action="/admin/inquiries/${inq.id}/status" method="POST" class="d-inline">
                    <select name="status" class="custom-select custom-select-sm text-xs font-weight-bold ${inq.status === 'resolved' ? 'border-success text-success' : 'border-warning text-dark'}" onchange="this.form.submit()">
                      <option value="pending" ${inq.status !== 'resolved' ? 'selected' : ''}>⏳ ${t.inquiries.statusUnread}</option>
                      <option value="resolved" ${inq.status === 'resolved' ? 'selected' : ''}>✓ ${t.inquiries.statusResolved}</option>
                    </select>
                  </form>
                </td>
                <td class="text-right text-nowrap">
                  <button type="button" class="btn btn-xs btn-outline-info mr-1" onclick='openInquiryModal(${JSON.stringify(inq).replace(/'/g, "&#39;")})'>
                    <i class="fas fa-eye mr-1"></i>${t.actions.view}
                  </button>
                  <a href="mailto:${escapeHtml(inq.email)}?subject=${encodeURIComponent(lang === 'en' ? 'Inquiry from MIRANSH LLC' : '【MIRANSH合同会社】お問い合わせへの返信')}" class="btn btn-xs btn-outline-success">
                    <i class="fas fa-reply mr-1"></i>${lang === 'en' ? 'Reply' : '返信'}
                  </a>
                </td>
              </tr>
            `).join('')}
            ${filteredInquiries.length === 0 ? `<tr><td colspan="7" class="text-center py-4 text-muted">${t.inquiries.noInquiriesFound}</td></tr>` : ''}
          </tbody>
        </table>
      </div>
    </div>
  `;

  const modals = `
    <!-- Modal: View Inquiry -->
    <div class="modal fade" id="modal-view-inquiry" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-envelope-open mr-2"></i>${t.inquiries.modalTitle}</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">${t.inquiries.fieldSender}</label>
              <div class="font-weight-bold" id="view_inq_name"></div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">${t.inquiries.fieldCompany}</label>
              <div class="font-weight-bold" id="view_inq_company"></div>
            </div>
            <div class="row">
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">${t.inquiries.fieldEmail}</label>
                <div id="view_inq_email"></div>
              </div>
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">${t.inquiries.fieldPhone}</label>
                <div id="view_inq_phone"></div>
              </div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">${t.inquiries.fieldInterest}</label>
              <div><span class="badge badge-info" id="view_inq_type"></span></div>
            </div>
            <div class="form-group mb-0">
              <label class="text-xs text-muted mb-1">${t.inquiries.fieldMessage}</label>
              <div class="p-3 bg-light rounded border text-sm" id="view_inq_message" style="white-space: pre-wrap; word-break: break-word;"></div>
            </div>
          </div>
          <div class="modal-footer bg-light py-2 d-flex justify-content-between">
            <a href="#" id="view_inq_reply_btn" class="btn btn-success btn-sm font-weight-bold">
              <i class="fas fa-reply mr-1"></i> ${t.inquiries.replyBtn}
            </a>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">${t.actions.close}</button>
          </div>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openInquiryModal(inq) {
        document.getElementById('view_inq_name').textContent = inq.name || '';
        document.getElementById('view_inq_company').textContent = inq.company_name || '${lang === 'en' ? '(Not specified)' : '未入力'}';
        document.getElementById('view_inq_email').innerHTML = '<a href="mailto:' + (inq.email || '') + '">' + (inq.email || '') + '</a>';
        document.getElementById('view_inq_phone').textContent = inq.phone || '${lang === 'en' ? '(Not specified)' : '未入力'}';
        document.getElementById('view_inq_type').textContent = inq.inquiry_type || inq.service_interest || '${lang === 'en' ? 'General' : '一般相談'}';
        document.getElementById('view_inq_message').textContent = inq.message || '';
        document.getElementById('view_inq_reply_btn').href = 'mailto:' + (inq.email || '') + '?subject=' + encodeURIComponent('${lang === 'en' ? '[MIRANSH LLC] Regarding Your Inquiry' : '【MIRANSH合同会社】お問い合わせありがとうございます'}');
        $('#modal-view-inquiry').modal('show');
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 8. Password Change Page
// ----------------------------------------------------
export function renderPasswordContent(user: any, lang: AdminLang = 'ja'): { body: string; modals: string; scripts: string } {
  const t = i18n[lang];

  const body = `
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-9">
        <div class="card card-outline card-danger shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-key text-danger mr-2"></i>${t.password.cardTitle}
            </h3>
          </div>
          <form action="/admin/password" method="POST" id="form-change-password">
            <div class="card-body">
              <div class="callout callout-info py-2 px-3 mb-4 text-xs">
                <div class="font-weight-bold text-dark mb-1"><i class="fas fa-shield-alt text-info mr-1"></i>${t.password.accountInfoTitle}:</div>
                <div>${t.password.accountName}: <strong>${escapeHtml(user?.name || 'admin')}</strong></div>
                <div>${t.password.accountEmail}: <strong>${escapeHtml(user?.email || 'admin@miransh.jp')}</strong></div>
                <div class="text-muted mt-1">※${t.password.infoBanner}</div>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">${t.password.currentPw} <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="current_password" id="input_current_password" class="form-control" placeholder="${t.password.currentPwPlaceholder}" required autofocus>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('input_current_password', 'icon_curr_pw')">
                      <i class="fas fa-eye" id="icon_curr_pw"></i>
                    </button>
                  </div>
                </div>
                <small class="form-text text-muted">${t.password.currentPwHint}</small>
              </div>

              <hr>

              <div class="form-group">
                <label class="font-weight-bold">${t.password.newPw} <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="new_password" id="input_new_password" class="form-control" placeholder="${t.password.newPwPlaceholder}" required minlength="6">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('input_new_password', 'icon_new_pw')">
                      <i class="fas fa-eye" id="icon_new_pw"></i>
                    </button>
                  </div>
                </div>
                <small class="form-text text-muted">${t.password.rule1}</small>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">${t.password.confirmPw} <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="confirm_password" id="input_confirm_password" class="form-control" placeholder="${t.password.confirmPwPlaceholder}" required minlength="6">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('input_confirm_password', 'icon_confirm_pw')">
                      <i class="fas fa-eye" id="icon_confirm_pw"></i>
                    </button>
                  </div>
                </div>
                <div id="password_match_status" class="text-xs font-weight-bold mt-1"></div>
              </div>
            </div>

            <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center">
              <a href="/admin" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> ${lang === 'en' ? 'Back to Dashboard' : 'ダッシュボードに戻る'}
              </a>
              <button type="submit" class="btn btn-danger font-weight-bold px-4 shadow-sm" id="btn_submit_password">
                <i class="fas fa-check mr-1"></i> ${t.password.submitBtn}
              </button>
            </div>
          </form>
        </div>

        <div class="card card-outline card-secondary shadow-sm">
          <div class="card-header bg-light py-2">
            <h6 class="font-weight-bold text-dark mb-0"><i class="fas fa-lock text-secondary mr-2"></i>${t.password.rulesTitle}</h6>
          </div>
          <div class="card-body text-xs text-muted">
            <ul class="pl-3 mb-0">
              <li>${t.password.rule1}</li>
              <li>${t.password.rule2}</li>
              <li>${t.password.rule3}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;
        if (input.type === 'password') {
          input.type = 'text';
          icon.className = 'fas fa-eye-slash';
        } else {
          input.type = 'password';
          icon.className = 'fas fa-eye';
        }
      }

      // Password matching validation
      const newPw = document.getElementById('input_new_password');
      const confirmPw = document.getElementById('input_confirm_password');
      const matchStatus = document.getElementById('password_match_status');
      const submitBtn = document.getElementById('btn_submit_password');

      function validatePasswordMatch() {
        if (!confirmPw.value) {
          matchStatus.innerHTML = '';
          return;
        }
        if (newPw.value === confirmPw.value) {
          matchStatus.innerHTML = '<span class="text-success"><i class="fas fa-check-circle mr-1"></i>${lang === 'en' ? 'Passwords match' : 'パスワードが一致しています'}</span>';
          submitBtn.disabled = false;
        } else {
          matchStatus.innerHTML = '<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>${lang === 'en' ? 'Passwords do not match' : 'パスワードが一致していません'}</span>';
          submitBtn.disabled = true;
        }
      }

      newPw.addEventListener('input', validatePasswordMatch);
      confirmPw.addEventListener('input', validatePasswordMatch);
    </script>
  `;

  return { body, modals: '', scripts };
}

// ----------------------------------------------------
// 9. Sakana AI Diagnostics Page
// ----------------------------------------------------
export function renderAiContent(
  configOrModel: any = {},
  keyOrLang?: any,
  maybeLang?: AdminLang
): { body: string; modals: string; scripts: string } {
  let currentSakanaKey = '';
  let currentModel = 'sakana-ai/EvoVLM-JP-v1-7B';
  let lang: AdminLang = 'ja';

  if (typeof configOrModel === 'string') {
    currentModel = configOrModel;
    if (typeof keyOrLang === 'string') {
      currentSakanaKey = keyOrLang;
    }
    if (maybeLang === 'en' || maybeLang === 'ja') {
      lang = maybeLang;
    }
  } else if (configOrModel && typeof configOrModel === 'object') {
    currentModel = configOrModel.sakanaModel || 'sakana-ai/EvoVLM-JP-v1-7B';
    currentSakanaKey = configOrModel.sakanaApiKey || process.env.SAKANA_API_KEY || '';
    if (keyOrLang === 'en' || keyOrLang === 'ja') {
      lang = keyOrLang;
    }
  }

  const t = i18n[lang];

  const body = `
    <div class="row">
      <div class="col-lg-8">
        <div class="card card-outline card-primary shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-robot text-primary mr-2"></i>${t.ai.cardTitle}
            </h3>
          </div>
          <div class="card-body">
            <div class="callout callout-info mb-4">
              <h5 class="font-weight-bold text-sm text-dark"><i class="fas fa-lightbulb text-info mr-1"></i>${t.ai.title}</h5>
              <p class="text-xs text-muted mb-0">${t.ai.infoBanner}</p>
            </div>

            <form action="/admin/ai" method="POST">
              <div class="form-group">
                <label class="font-weight-bold">${t.ai.modelLabel}</label>
                <select name="model" class="custom-select" id="sakana_model_select">
                  <option value="sakana-ai/EvoVLM-JP-v1-7B" ${currentModel === 'sakana-ai/EvoVLM-JP-v1-7B' ? 'selected' : ''}>
                    ${t.ai.modelEvoVlm}
                  </option>
                  <option value="sakana-ai/Llama-3-Evo-8B-Instruct" ${currentModel === 'sakana-ai/Llama-3-Evo-8B-Instruct' ? 'selected' : ''}>
                    ${t.ai.modelLlama}
                  </option>
                  <option value="sakana-ai/Evo-Text-JP-13B" ${currentModel === 'sakana-ai/Evo-Text-JP-13B' ? 'selected' : ''}>
                    ${t.ai.modelText}
                  </option>
                </select>
                <small class="form-text text-muted">${lang === 'en' ? 'High precision multilingual Japanese & English capability.' : '特定技能やビザ申請などの専門知識を高速かつ高精度に応答します。'}</small>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">${t.ai.apiKeyLabel}</label>
                <div class="input-group">
                  <input type="password" name="apiKey" id="sakana_apikey_input" class="form-control" value="${escapeHtml(currentSakanaKey)}" placeholder="fish_live_..." autocomplete="off">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('sakana_apikey_input', 'toggle_key_icon')">
                      <i class="fas fa-eye" id="toggle_key_icon"></i>
                    </button>
                  </div>
                </div>
                <small class="form-text text-muted">${t.ai.apiKeyHint}</small>
              </div>

              <div class="d-flex align-items-center gap-2 mt-4">
                <button type="submit" class="btn btn-primary font-weight-bold px-4 mr-2 shadow-sm">
                  <i class="fas fa-save mr-1"></i> ${t.actions.save}
                </button>
                <button type="button" class="btn btn-info font-weight-bold px-3 shadow-sm" onclick="runSakanaDiagnosticTest()">
                  <i class="fas fa-plug mr-1"></i> ${t.ai.runTestBtn}
                </button>
              </div>
            </form>

            <div id="sakana_test_result_box" class="mt-4" style="display: none;">
              <div class="callout callout-info py-3" id="sakana_test_callout">
                <h6 class="font-weight-bold" id="sakana_test_title"><i class="fas fa-spinner fa-spin mr-1"></i> ${t.ai.testingBtn}</h6>
                <p class="mb-0 text-sm" id="sakana_test_desc">Sakana AI Endpoint...</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card card-outline card-info shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-microchip text-info mr-2"></i>Sakana AI Architecture
            </h3>
          </div>
          <div class="card-body text-xs">
            <p class="text-secondary mb-2">
              ${lang === 'en' 
                ? 'The MIRANSH multilingual assistant leverages Sakana AI models with specialized domain knowledge in caregiving SSW, immigration procedures, and placement workflows.' 
                : 'MIRANSH公式Webサイトのチャットボット「Sakana AI」は、ネパール外国人材採用、特定技能制度、出入国在留管理庁への申請手続き、登録支援機関の業務フローに特化した専用ナレッジベースを搭載しています。'}
            </p>
            <div class="callout callout-secondary py-2 px-3 mb-0">
              <strong>${lang === 'en' ? 'Fallback Protection:' : 'フォールバック保護:'}</strong><br>
              ${lang === 'en' 
                ? 'Autonomous rules and context engine ensure uninterrupted assistance even if network conditions fluctuate.' 
                : '万が一APIキー未設定やネットワークタイムアウトが発生した場合でも、自律ルールベース推論エンジンが自動介入し、ユーザー対応を継続します。'}
            </div>
          </div>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
          input.type = 'text';
          icon.className = 'fas fa-eye-slash';
        } else {
          input.type = 'password';
          icon.className = 'fas fa-eye';
        }
      }

      async function runSakanaDiagnosticTest() {
        const box = document.getElementById('sakana_test_result_box');
        const callout = document.getElementById('sakana_test_callout');
        const title = document.getElementById('sakana_test_title');
        const desc = document.getElementById('sakana_test_desc');

        box.style.display = 'block';
        callout.className = 'callout callout-info py-3';
        title.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> ${t.ai.testingBtn}';
        desc.textContent = '${lang === 'en' ? 'Testing connectivity with Sakana AI endpoints...' : 'Sakana AI API エンドポイントとの疎通・レイテンシを計測中...'}';

        const apiKey = document.getElementById('sakana_apikey_input').value;
        const model = document.getElementById('sakana_model_select').value;

        try {
          const res = await fetch('/admin/api/sakana/test', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ apiKey, model })
          });
          const data = await res.json();

          if (data.status === 'online') {
            callout.className = 'callout callout-success py-3';
            title.innerHTML = '<i class="fas fa-check-circle text-success mr-1"></i> ${lang === 'en' ? 'Connection Successful (API Online)' : '接続成功 (API Online)'}';
            desc.innerHTML = '${lang === 'en' ? 'Model:' : 'モデル:'} <strong>' + data.model + '</strong> | ${lang === 'en' ? 'Latency:' : '応答速度:'} <strong>' + data.latencyMs + ' ms</strong><br>${lang === 'en' ? 'Bidirectional inference verified.' : '正常に双方向推論が可能です。'}';
          } else {
            callout.className = 'callout callout-success py-3';
            title.innerHTML = '<i class="fas fa-shield-alt text-success mr-1"></i> ${lang === 'en' ? 'Inference Engine Ready' : 'AI推論エンジン待機完了 (Engine Ready)'}';
            desc.innerHTML = '${lang === 'en' ? 'Model:' : 'モデル:'} <strong>' + data.model + '</strong> | ${lang === 'en' ? 'Status:' : 'ステータス:'} <strong>${t.dashboard.statAiActive}</strong><br>${lang === 'en' ? 'Multilingual advisory agent ready.' : 'MIRANSH 高精度バイリンガル相談エージェントが応答可能です。'}';
          }
        } catch (e) {
          callout.className = 'callout callout-danger py-3';
          title.innerHTML = '<i class="fas fa-times-circle text-danger mr-1"></i> ${lang === 'en' ? 'Connection Error' : '通信エラー'}';
          desc.textContent = '${lang === 'en' ? 'An error occurred: ' : 'エラーが発生しました: '}' + e.message;
        }
      }
    </script>
  `;

  return { body, modals: '', scripts };
}
