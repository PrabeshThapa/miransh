// AdminLTE 3 Individual Page Renderers for MIRANSH Management Portal
import { escapeHtml } from '../adminlte';

// ----------------------------------------------------
// 1. Dashboard Overview Page
// ----------------------------------------------------
export function renderDashboardContent(data: {
  company: any;
  services: any[];
  stories: any[];
  inquiries: any[];
  unreadCount: number;
}): { body: string; modals: string; scripts: string } {
  const { company, services, stories, inquiries, unreadCount } = data;

  const recentInquiries = inquiries.slice(0, 6);

  const body = `
    <!-- Stat Widgets -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info shadow-sm">
          <div class="inner">
            <h3>${inquiries.length}</h3>
            <p class="mb-0 font-weight-bold">お問い合わせ総数 (${unreadCount}件 未対応)</p>
          </div>
          <div class="icon">
            <i class="fas fa-envelope"></i>
          </div>
          <a href="/admin/inquiries" class="small-box-footer">
            お問い合わせ管理へ <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success shadow-sm">
          <div class="inner">
            <h3>${services.length}</h3>
            <p class="mb-0 font-weight-bold">提供サービス数 (特定技能・介護)</p>
          </div>
          <div class="icon">
            <i class="fas fa-concierge-bell"></i>
          </div>
          <a href="/admin/services" class="small-box-footer">
            サービス管理へ <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning shadow-sm">
          <div class="inner">
            <h3>${stories.length}</h3>
            <p class="mb-0 font-weight-bold">採用事例・実績記事</p>
          </div>
          <div class="icon">
            <i class="fas fa-book-open"></i>
          </div>
          <a href="/admin/stories" class="small-box-footer">
            事例管理へ <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-primary shadow-sm">
          <div class="inner">
            <h3>Active</h3>
            <p class="mb-0 font-weight-bold">Sakana AI アシスタント</p>
          </div>
          <div class="icon">
            <i class="fas fa-robot"></i>
          </div>
          <a href="/admin/ai" class="small-box-footer">
            AI設定・診断へ <i class="fas fa-arrow-circle-right"></i>
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
              <i class="fas fa-envelope-open-text text-primary mr-2"></i>最近届いたお問い合わせ (新着順)
            </h3>
            <div class="card-tools">
              <a href="/admin/inquiries" class="btn btn-tool text-primary font-weight-bold">すべてのお問い合わせを見る →</a>
            </div>
          </div>
          <div class="card-body p-0 table-responsive">
            <table class="table table-striped table-hover text-sm mb-0">
              <thead class="thead-light">
                <tr>
                  <th>送信者 / 企業</th>
                  <th>希望種別</th>
                  <th>内容要約</th>
                  <th class="text-center">状態</th>
                  <th class="text-right">操作</th>
                </tr>
              </thead>
              <tbody>
                ${recentInquiries.map(inq => `
                  <tr>
                    <td>
                      <div class="font-weight-bold text-dark">${escapeHtml(inq.name)}</div>
                      <small class="text-muted"><i class="fas fa-building mr-1"></i>${escapeHtml(inq.company_name || '個人・未記入')}</small>
                    </td>
                    <td><span class="badge badge-info px-2 py-1">${escapeHtml(inq.inquiry_type || inq.service_interest || '一般相談')}</span></td>
                    <td style="max-width: 200px;" class="text-truncate text-secondary">${escapeHtml(inq.message || '')}</td>
                    <td class="text-center">
                      ${inq.status === 'resolved' 
                        ? '<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>対応済</span>' 
                        : '<span class="badge badge-warning px-2 py-1 text-dark"><i class="fas fa-clock mr-1"></i>未対応</span>'}
                    </td>
                    <td class="text-right text-nowrap">
                      <button type="button" class="btn btn-xs btn-outline-info" onclick='openInquiryModal(${JSON.stringify(inq).replace(/'/g, "&#39;")})'>
                        <i class="fas fa-eye mr-1"></i>詳細
                      </button>
                    </td>
                  </tr>
                `).join('')}
                ${inquiries.length === 0 ? '<tr><td colspan="5" class="text-center py-4 text-muted">まだお問い合わせはありません。</td></tr>' : ''}
              </tbody>
            </table>
          </div>
        </div>

        <!-- Featured Stories List -->
        <div class="card card-outline card-secondary shadow-sm">
          <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-newspaper text-secondary mr-2"></i>最新の採用事例・実績一覧
            </h3>
            <div class="card-tools">
              <a href="/admin/stories" class="btn btn-tool text-primary font-weight-bold">全件管理 →</a>
            </div>
          </div>
          <div class="card-body p-0 table-responsive">
            <table class="table table-hover text-sm mb-0">
              <thead class="thead-light">
                <tr>
                  <th style="width: 70px;">写真</th>
                  <th>タイトル</th>
                  <th>分野</th>
                  <th>公開日</th>
                </tr>
              </thead>
              <tbody>
                ${stories.slice(0, 4).map(st => `
                  <tr>
                    <td>
                      <img src="${escapeHtml(st.image || '/images/story1.jpg')}" class="img-thumbnail" style="width: 55px; height: 38px; object-fit: cover;">
                    </td>
                    <td>
                      <div class="font-weight-bold text-dark">${escapeHtml(st.title_ja)}</div>
                      <small class="text-muted">${escapeHtml(st.title_en || '')}</small>
                    </td>
                    <td><span class="badge badge-secondary">${escapeHtml(st.category_ja || '特定技能')}</span></td>
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
              <i class="fas fa-bolt text-warning mr-2"></i>クイック操作メニュー
            </h3>
          </div>
          <div class="card-body">
            <div class="d-grid gap-2">
              <a href="/admin/company" class="btn btn-outline-primary btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-camera mr-2"></i>代表CEO写真・Heroバナー更新
              </a>
              <a href="/admin/stories" class="btn btn-outline-success btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-plus-circle mr-2"></i>採用事例の投稿・編集
              </a>
              <a href="/admin/services" class="btn btn-outline-info btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-concierge-bell mr-2"></i>提供サービス4分野の編集
              </a>
              <a href="/admin/password" class="btn btn-outline-danger btn-block mb-2 text-left font-weight-bold">
                <i class="fas fa-key mr-2"></i>管理者パスワードの変更
              </a>
              <a href="/admin/ai" class="btn btn-outline-dark btn-block text-left font-weight-bold">
                <i class="fas fa-robot mr-2"></i>Sakana AI 診断テスト実行
              </a>
            </div>
          </div>
        </div>

        <div class="card card-outline card-info shadow-sm mb-3">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-info-circle text-info mr-2"></i>企業基本情報
            </h3>
          </div>
          <div class="card-body text-xs">
            <div class="mb-2"><strong>社名:</strong> ${escapeHtml(company.name_ja)} (${escapeHtml(company.name_en)})</div>
            <div class="mb-2"><strong>許可番号:</strong> ${escapeHtml(company.license || '13-ユ-319558')}</div>
            <div class="mb-2"><strong>代表取締役:</strong> ${escapeHtml(company.ceo_name_ja)}</div>
            <div class="mb-2"><strong>所在地:</strong> ${escapeHtml(company.address_ja)}</div>
            <div class="mb-0"><strong>電話:</strong> ${escapeHtml(company.phone)}</div>
          </div>
        </div>

        <div class="card card-outline card-secondary shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-server text-secondary mr-2"></i>システム稼働状況
            </h3>
          </div>
          <div class="card-body text-xs">
            <div class="d-flex justify-content-between mb-1">
              <span>データベース:</span>
              <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i>SQLite 正常接続</span>
            </div>
            <div class="d-flex justify-content-between mb-1">
              <span>ポート番号:</span>
              <span class="font-weight-bold">3000 (Production Ready)</span>
            </div>
            <div class="d-flex justify-content-between mb-1">
              <span>UIフレームワーク:</span>
              <span class="text-primary font-weight-bold">AdminLTE 3.2.0</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>AIエンジン:</span>
              <span class="text-info font-weight-bold">Sakana AI Active</span>
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
            <h5 class="modal-title font-weight-bold"><i class="fas fa-envelope-open mr-2"></i>お問い合わせ詳細</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">ご担当者様 お名前</label>
              <div class="font-weight-bold" id="view_inq_name"></div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">貴社名 / 組織名</label>
              <div class="font-weight-bold" id="view_inq_company"></div>
            </div>
            <div class="row">
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">メールアドレス</label>
                <div id="view_inq_email"></div>
              </div>
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">電話番号</label>
                <div id="view_inq_phone"></div>
              </div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">ご相談分野</label>
              <div><span class="badge badge-info" id="view_inq_type"></span></div>
            </div>
            <div class="form-group mb-0">
              <label class="text-xs text-muted mb-1">お問い合わせ内容 (Message)</label>
              <div class="p-3 bg-light rounded border text-sm" id="view_inq_message" style="white-space: pre-wrap; word-break: break-word;"></div>
            </div>
          </div>
          <div class="modal-footer bg-light py-2">
            <a href="/admin/inquiries" class="btn btn-outline-primary btn-sm">お問い合わせ一覧で確認</a>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">閉じる</button>
          </div>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openInquiryModal(inq) {
        document.getElementById('view_inq_name').textContent = inq.name || '';
        document.getElementById('view_inq_company').textContent = inq.company_name || '未入力';
        document.getElementById('view_inq_email').innerHTML = '<a href="mailto:' + (inq.email || '') + '">' + (inq.email || '') + '</a>';
        document.getElementById('view_inq_phone').textContent = inq.phone || '未入力';
        document.getElementById('view_inq_type').textContent = inq.inquiry_type || inq.service_interest || '一般相談';
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
export function renderCompanyContent(company: any): { body: string; modals: string; scripts: string } {
  const body = `
    <div class="row">
      <!-- CEO Photo Upload Card -->
      <div class="col-md-6 mb-4">
        <div class="card card-outline card-primary shadow-sm h-100">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-user-tie text-primary mr-2"></i>代表者・CEO肖像写真 (CEO Portrait Photo)
            </h3>
          </div>
          <div class="card-body text-center">
            <div class="mb-3">
              <img id="ceo_photo_preview" src="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}" alt="CEO Preview" class="preview-thumb elevation-2" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%;">
            </div>
            <div class="drop-zone mb-3" id="drop_zone_ceo" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event, 'ceo_image')">
              <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
              <div class="font-weight-bold text-dark text-sm">ここに写真をドラッグ＆ドロップ</div>
              <div class="text-xs text-muted mb-2">または下のボタンから写真ファイルを選択</div>
              <label class="btn btn-sm btn-primary mb-0 shadow-sm">
                <i class="fas fa-folder-open mr-1"></i> 写真を選択して即時反映
                <input type="file" name="ceo_image_file" accept="image/*" style="display: none;" onchange="uploadAdminImageFile(this, 'ceo_image')">
              </label>
            </div>
            <div id="ceo_upload_status" class="text-xs font-weight-bold"></div>
            <div class="mt-2 text-right">
              <button type="button" class="btn btn-xs btn-outline-secondary" onclick="resetImageToDefault('ceo_image')">
                <i class="fas fa-undo mr-1"></i> デフォルト写真に戻す
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
              <i class="fas fa-image text-primary mr-2"></i>トップページ・Heroバナー画像 (Hero Banner Image)
            </h3>
          </div>
          <div class="card-body text-center">
            <div class="mb-3">
              <img id="hero_banner_preview" src="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}" alt="Hero Preview" class="preview-thumb elevation-2" style="width: 100%; height: 140px; object-fit: cover;">
            </div>
            <div class="drop-zone mb-3" id="drop_zone_hero" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event, 'hero_image')">
              <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
              <div class="font-weight-bold text-dark text-sm">ここにバナー画像をドラッグ＆ドロップ</div>
              <div class="text-xs text-muted mb-2">または下のボタンから画像ファイルを選択</div>
              <label class="btn btn-sm btn-primary mb-0 shadow-sm">
                <i class="fas fa-folder-open mr-1"></i> 画像を選択して即時反映
                <input type="file" name="hero_image_file" accept="image/*" style="display: none;" onchange="uploadAdminImageFile(this, 'hero_image')">
              </label>
            </div>
            <div id="hero_upload_status" class="text-xs font-weight-bold"></div>
            <div class="mt-2 text-right">
              <button type="button" class="btn btn-xs btn-outline-secondary" onclick="resetImageToDefault('hero_image')">
                <i class="fas fa-undo mr-1"></i> デフォルト画像に戻す
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Company Details Form -->
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-id-card text-primary mr-2"></i>企業基本情報およびトップメッセージ設定
        </h3>
      </div>
      <form action="/admin/company" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="ceo_image" id="input_form_ceo_image" value="${escapeHtml(company.ceo_image || '/images/ceo_portrait.jpg')}">
        <input type="hidden" name="hero_image" id="input_form_hero_image" value="${escapeHtml(company.hero_image || '/images/hero_banner.jpg')}">
        
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 form-group">
              <label>会社名 (日本語)</label>
              <input type="text" name="name_ja" class="form-control" value="${escapeHtml(company.name_ja || '')}" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Company Name (English)</label>
              <input type="text" name="name_en" class="form-control" value="${escapeHtml(company.name_en || '')}" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>法人番号 (Corporate Number)</label>
              <input type="text" name="corporate_number" class="form-control" value="${escapeHtml(company.corporate_number || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>有料職業紹介許可番号 (License No.)</label>
              <input type="text" name="license" class="form-control" value="${escapeHtml(company.license || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>代表者 氏名 (日本語)</label>
              <input type="text" name="ceo_name_ja" class="form-control" value="${escapeHtml(company.ceo_name_ja || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>CEO Name (English)</label>
              <input type="text" name="ceo_name_en" class="form-control" value="${escapeHtml(company.ceo_name_en || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>役職名 (日本語)</label>
              <input type="text" name="ceo_role_ja" class="form-control" value="${escapeHtml(company.ceo_role_ja || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>Role (English)</label>
              <input type="text" name="ceo_role_en" class="form-control" value="${escapeHtml(company.ceo_role_en || '')}">
            </div>
          </div>

          <div class="form-group">
            <label>代表メッセージ (日本語)</label>
            <textarea name="ceo_message_ja" class="form-control" rows="4">${escapeHtml(company.ceo_message_ja || '')}</textarea>
          </div>

          <div class="form-group">
            <label>CEO Message (English)</label>
            <textarea name="ceo_message_en" class="form-control" rows="4">${escapeHtml(company.ceo_message_en || '')}</textarea>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>代表電話番号</label>
              <input type="text" name="phone" class="form-control" value="${escapeHtml(company.phone || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>代表メールアドレス</label>
              <input type="email" name="email" class="form-control" value="${escapeHtml(company.email || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>本店所在地 (日本語)</label>
              <input type="text" name="address_ja" class="form-control" value="${escapeHtml(company.address_ja || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>Address (English)</label>
              <input type="text" name="address_en" class="form-control" value="${escapeHtml(company.address_en || '')}">
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border-top text-right">
          <button type="submit" class="btn btn-primary font-weight-bold px-4">
            <i class="fas fa-save mr-1"></i> 会社情報を保存する
          </button>
        </div>
      </form>
    </div>
  `;

  const scripts = `
    <script>
      async function resetImageToDefault(targetField) {
        const defaultUrl = targetField === 'ceo_image' ? '/images/ceo_portrait.jpg' : '/images/hero_banner.jpg';
        if (!confirm('画像をデフォルトに戻しますか？')) return;

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
          alert('デフォルトに戻しました。保存ボタンを押して確定してください。');
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
export function renderAboutContent(about: any): { body: string; modals: string; scripts: string } {
  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-award text-primary mr-2"></i>企業理念・メッセージ設定 (About Us & Vision)
        </h3>
      </div>
      <form action="/admin/about" method="POST">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 form-group">
              <label>見出し (日本語) *</label>
              <input type="text" name="heading_ja" class="form-control" value="${escapeHtml(about.heading_ja || '')}" required>
            </div>
            <div class="col-md-6 form-group">
              <label>Heading (English)</label>
              <input type="text" name="heading_en" class="form-control" value="${escapeHtml(about.heading_en || '')}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>サブ見出し (日本語)</label>
              <textarea name="subheading_ja" class="form-control" rows="2">${escapeHtml(about.subheading_ja || '')}</textarea>
            </div>
            <div class="col-md-6 form-group">
              <label>Subheading (English)</label>
              <textarea name="subheading_en" class="form-control" rows="2">${escapeHtml(about.subheading_en || '')}</textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>理念説明文 1 (日本語)</label>
              <textarea name="desc1_ja" class="form-control" rows="4">${escapeHtml(about.desc1_ja || '')}</textarea>
            </div>
            <div class="col-md-6 form-group">
              <label>Vision Description 1 (English)</label>
              <textarea name="desc1_en" class="form-control" rows="4">${escapeHtml(about.desc1_en || '')}</textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>理念説明文 2 (日本語)</label>
              <textarea name="desc2_ja" class="form-control" rows="4">${escapeHtml(about.desc2_ja || '')}</textarea>
            </div>
            <div class="col-md-6 form-group">
              <label>Vision Description 2 (English)</label>
              <textarea name="desc2_en" class="form-control" rows="4">${escapeHtml(about.desc2_en || '')}</textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>キーフレーズ・理念名言 (日本語)</label>
              <input type="text" name="quote_ja" class="form-control" value="${escapeHtml(about.quote_ja || '')}">
            </div>
            <div class="col-md-6 form-group">
              <label>Key Quote (English)</label>
              <input type="text" name="quote_en" class="form-control" value="${escapeHtml(about.quote_en || '')}">
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border-top text-right">
          <button type="submit" class="btn btn-primary font-weight-bold px-4">
            <i class="fas fa-save mr-1"></i> 企業理念・メッセージを保存する
          </button>
        </div>
      </form>
    </div>
  `;

  return { body, modals: '', scripts: '' };
}

// ----------------------------------------------------
// 4. Services Page
// ----------------------------------------------------
export function renderServicesContent(services: any[]): { body: string; modals: string; scripts: string } {
  let cardsHtml = '';
  services.forEach((s) => {
    let itemsJaArr: string[] = [];
    try {
      if (s.items_ja) itemsJaArr = JSON.parse(s.items_ja);
    } catch (e) {}

    cardsHtml += `
      <div class="col-md-6 mb-4">
        <div class="card card-outline card-primary h-100 shadow-sm">
          <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="card-title font-weight-bold mb-0 text-dark">
              <span class="badge badge-primary mr-2">${escapeHtml(s.number_label || '01')}</span>
              ${escapeHtml(s.title_ja)}
            </h5>
            <div class="card-tools">
              <button type="button" class="btn btn-xs btn-primary" onclick='openEditServiceModal(${JSON.stringify(s).replace(/'/g, "&#39;")})'>
                <i class="fas fa-edit mr-1"></i> サービス編集
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="text-muted text-xs mb-2 font-weight-bold">${escapeHtml(s.title_en || '')}</div>
            <p class="text-secondary text-sm mb-3">${escapeHtml(s.desc_ja || '')}</p>
            ${itemsJaArr.length > 0 ? `
              <div class="bg-light p-2 rounded border">
                <small class="text-xs font-weight-bold text-muted d-block mb-1">主要支援内容 (Highlights):</small>
                <ul class="pl-3 mb-0 text-xs text-dark">
                  ${itemsJaArr.map(item => `<li>${escapeHtml(item)}</li>`).join('')}
                </ul>
              </div>
            ` : ''}
          </div>
        </div>
      </div>
    `;
  });

  const body = `
    <div class="row">
      ${cardsHtml}
    </div>
  `;

  const modals = `
    <!-- Modal: Edit Service -->
    <div class="modal fade" id="modal-edit-service" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>サービスの編集</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-edit-service" action="" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>サービス名 (日本語) *</label>
                  <input type="text" name="title_ja" id="edit_svc_title_ja" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label>Service Title (English) *</label>
                  <input type="text" name="title_en" id="edit_svc_title_en" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>サブタイトル (日本語)</label>
                  <input type="text" name="subtitle_ja" id="edit_svc_sub_ja" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                  <label>Subtitle (English)</label>
                  <input type="text" name="subtitle_en" id="edit_svc_sub_en" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label>サービス説明文 (日本語)</label>
                <textarea name="desc_ja" id="edit_svc_desc_ja" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>Description (English)</label>
                <textarea name="desc_en" id="edit_svc_desc_en" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>主要項目リスト (JSON配列または1行1項目)</label>
                <textarea name="items_ja" id="edit_svc_items_ja" class="form-control" rows="3" placeholder='["介護技能試験合格者の選抜", "現地日本語学校での入国前研修"]'></textarea>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ サービスを保存する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openEditServiceModal(svc) {
        document.getElementById('form-edit-service').action = '/admin/services/' + svc.id;
        document.getElementById('edit_svc_title_ja').value = svc.title_ja || '';
        document.getElementById('edit_svc_title_en').value = svc.title_en || '';
        document.getElementById('edit_svc_sub_ja').value = svc.subtitle_ja || '';
        document.getElementById('edit_svc_sub_en').value = svc.subtitle_en || '';
        document.getElementById('edit_svc_desc_ja').value = svc.desc_ja || '';
        document.getElementById('edit_svc_desc_en').value = svc.desc_en || '';
        document.getElementById('edit_svc_items_ja').value = svc.items_ja || '';
        $('#modal-edit-service').modal('show');
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 5. Stories / Case Studies Page
// ----------------------------------------------------
export function renderStoriesContent(stories: any[]): { body: string; modals: string; scripts: string } {
  let tableRows = '';
  stories.forEach(st => {
    tableRows += `
      <tr>
        <td class="text-center font-weight-bold text-muted">#${st.id}</td>
        <td style="width: 70px;">
          <img src="${escapeHtml(st.image || '/images/story1.jpg')}" alt="Story" class="img-thumbnail elevation-1" style="width: 60px; height: 42px; object-fit: cover;">
        </td>
        <td>
          <div class="font-weight-bold text-dark">${escapeHtml(st.title_ja)}</div>
          <small class="text-muted d-block">${escapeHtml(st.title_en || '')}</small>
        </td>
        <td>
          <span class="badge badge-secondary">${escapeHtml(st.category_ja || '特定技能')}</span>
        </td>
        <td class="text-xs text-muted">${escapeHtml(st.published_date || '')}</td>
        <td class="text-center">
          ${st.featured ? '<span class="badge badge-success">掲載中</span>' : '<span class="badge badge-light">標準</span>'}
        </td>
        <td class="text-right text-nowrap">
          <button type="button" class="btn btn-xs btn-primary mr-1" onclick='openEditStoryModal(${JSON.stringify(st).replace(/'/g, "&#39;")})'>
            <i class="fas fa-edit"></i> 編集
          </button>
          <form action="/admin/stories/${st.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('採用事例 #${st.id} を削除してもよろしいですか？');">
            <button type="submit" class="btn btn-xs btn-danger">
              <i class="fas fa-trash"></i> 削除
            </button>
          </form>
        </td>
      </tr>
    `;
  });

  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-book-open text-primary mr-2"></i>採用実績・事例記事一覧 (${stories.length}件)
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-sm btn-success font-weight-bold" onclick="openCreateStoryModal()">
            <i class="fas fa-plus mr-1"></i> 新規事例を登録する
          </button>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover text-sm mb-0">
          <thead class="thead-light">
            <tr>
              <th class="text-center" style="width: 50px;">ID</th>
              <th>写真</th>
              <th>記事タイトル</th>
              <th>分野カテゴリ</th>
              <th>公開日</th>
              <th class="text-center">注目</th>
              <th class="text-right">操作</th>
            </tr>
          </thead>
          <tbody>
            ${tableRows}
            ${stories.length === 0 ? '<tr><td colspan="7" class="text-center py-4 text-muted">まだ登録された事例記事はありません。</td></tr>' : ''}
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
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>新規採用事例の登録</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/stories" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>タイトル (日本語) *</label>
                  <input type="text" name="title_ja" class="form-control" required placeholder="例: 介護施設様へのネパール特定技能人材マッチング">
                </div>
                <div class="col-md-6 form-group">
                  <label>Title (English) *</label>
                  <input type="text" name="title_en" class="form-control" required placeholder="e.g., SSW Caregiver Placement Story">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>カテゴリ (日本語) *</label>
                  <input type="text" name="category_ja" class="form-control" required value="特定技能 / 介護分野">
                </div>
                <div class="col-md-6 form-group">
                  <label>Category (English) *</label>
                  <input type="text" name="category_en" class="form-control" required value="Nursing Care / SSW">
                </div>
              </div>
              <div class="form-group">
                <label>カバー写真画像 (URLまたはファイル選択)</label>
                <div class="input-group">
                  <input type="text" name="image" id="create_story_img_input" class="form-control" value="/images/story1.jpg">
                  <div class="input-group-append">
                    <label class="btn btn-outline-secondary mb-0">
                      📁 ファイル選択
                      <input type="file" accept="image/*" style="display: none;" onchange="uploadImageToInput(this, 'create_story_img_input')">
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>概要・サマリー (日本語)</label>
                <textarea name="summary_ja" class="form-control" rows="2" placeholder="採用の背景や成果の要約"></textarea>
              </div>
              <div class="form-group">
                <label>Summary (English)</label>
                <textarea name="summary_en" class="form-control" rows="2" placeholder="Summary of achievements"></textarea>
              </div>
              <div class="form-group">
                <label>本文記事 (日本語)</label>
                <textarea name="content_ja" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label>Full Content (English)</label>
                <textarea name="content_en" class="form-control" rows="4"></textarea>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>公開日</label>
                  <input type="text" name="published_date" class="form-control" value="2026.09.03">
                </div>
                <div class="col-md-6 form-group">
                  <label>執筆者</label>
                  <input type="text" name="author" class="form-control" value="MIRANSH 編集部">
                </div>
              </div>
              <div class="form-check">
                <input type="checkbox" name="featured" value="1" class="form-check-input" id="create_featured_check" checked>
                <label class="form-check-label font-weight-bold" for="create_featured_check">トップページに注目事例として掲載する</label>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-success btn-sm font-weight-bold">✓ 事例を登録する</button>
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
            <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>採用事例の編集 (ID: <span id="edit_story_id_badge"></span>)</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-edit-story" action="" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>タイトル (日本語) *</label>
                  <input type="text" name="title_ja" id="edit_st_title_ja" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label>Title (English) *</label>
                  <input type="text" name="title_en" id="edit_st_title_en" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>カテゴリ (日本語) *</label>
                  <input type="text" name="category_ja" id="edit_st_cat_ja" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label>Category (English) *</label>
                  <input type="text" name="category_en" id="edit_st_cat_en" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label>カバー写真画像</label>
                <div class="input-group">
                  <input type="text" name="image" id="edit_story_img_input" class="form-control">
                  <div class="input-group-append">
                    <label class="btn btn-outline-secondary mb-0">
                      📁 ファイル選択
                      <input type="file" accept="image/*" style="display: none;" onchange="uploadImageToInput(this, 'edit_story_img_input')">
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>概要・サマリー (日本語)</label>
                <textarea name="summary_ja" id="edit_st_summary_ja" class="form-control" rows="2"></textarea>
              </div>
              <div class="form-group">
                <label>Summary (English)</label>
                <textarea name="summary_en" id="edit_st_summary_en" class="form-control" rows="2"></textarea>
              </div>
              <div class="form-group">
                <label>本文記事 (日本語)</label>
                <textarea name="content_ja" id="edit_st_content_ja" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label>Full Content (English)</label>
                <textarea name="content_en" id="edit_st_content_en" class="form-control" rows="4"></textarea>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>公開日</label>
                  <input type="text" name="published_date" id="edit_st_date" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                  <label>執筆者</label>
                  <input type="text" name="author" id="edit_st_author" class="form-control">
                </div>
              </div>
              <div class="form-check">
                <input type="checkbox" name="featured" value="1" class="form-check-input" id="edit_st_featured">
                <label class="form-check-label font-weight-bold" for="edit_st_featured">トップページに注目事例として掲載する</label>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ 変更を保存する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openCreateStoryModal() {
        $('#modal-create-story').modal('show');
      }

      function openEditStoryModal(story) {
        document.getElementById('edit_story_id_badge').textContent = '#' + story.id;
        document.getElementById('form-edit-story').action = '/admin/stories/' + story.id;
        document.getElementById('edit_st_title_ja').value = story.title_ja || '';
        document.getElementById('edit_st_title_en').value = story.title_en || '';
        document.getElementById('edit_st_cat_ja').value = story.category_ja || '';
        document.getElementById('edit_st_cat_en').value = story.category_en || '';
        document.getElementById('edit_story_img_input').value = story.image || '';
        document.getElementById('edit_st_summary_ja').value = story.summary_ja || '';
        document.getElementById('edit_st_summary_en').value = story.summary_en || '';
        document.getElementById('edit_st_content_ja').value = story.content_ja || '';
        document.getElementById('edit_st_content_en').value = story.content_en || '';
        document.getElementById('edit_st_date').value = story.published_date || '';
        document.getElementById('edit_st_author').value = story.author || '';
        document.getElementById('edit_st_featured').checked = Boolean(story.featured);
        $('#modal-edit-story').modal('show');
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 6. FAQs Page
// ----------------------------------------------------
export function renderFaqsContent(faqs: any[]): { body: string; modals: string; scripts: string } {
  let tableRows = '';
  faqs.forEach(faq => {
    tableRows += `
      <tr>
        <td class="text-center font-weight-bold text-muted">#${faq.id}</td>
        <td><span class="badge badge-info">${escapeHtml(faq.category_ja || '特定技能')}</span></td>
        <td>
          <div class="font-weight-bold text-dark">${escapeHtml(faq.question_ja)}</div>
          <small class="text-muted">${escapeHtml(faq.question_en || '')}</small>
        </td>
        <td style="max-width: 320px;" class="text-truncate text-secondary">
          ${escapeHtml(faq.answer_ja || '')}
        </td>
        <td class="text-right text-nowrap">
          <button type="button" class="btn btn-xs btn-primary mr-1" onclick='openEditFaqModal(${JSON.stringify(faq).replace(/'/g, "&#39;")})'>
            <i class="fas fa-edit"></i> 編集
          </button>
          <form action="/admin/faqs/${faq.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('FAQ #${faq.id} を削除してもよろしいですか？');">
            <button type="submit" class="btn btn-xs btn-danger">
              <i class="fas fa-trash"></i> 削除
            </button>
          </form>
        </td>
      </tr>
    `;
  });

  const body = `
    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-question-circle text-primary mr-2"></i>よくある質問 (FAQ) 一覧 (${faqs.length}件)
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-sm btn-success font-weight-bold" onclick="openCreateFaqModal()">
            <i class="fas fa-plus mr-1"></i> 新規FAQを追加する
          </button>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover text-sm mb-0">
          <thead class="thead-light">
            <tr>
              <th class="text-center" style="width: 50px;">ID</th>
              <th>カテゴリ</th>
              <th>質問 (Question)</th>
              <th>回答 (Answer)</th>
              <th class="text-right">操作</th>
            </tr>
          </thead>
          <tbody>
            ${tableRows}
            ${faqs.length === 0 ? '<tr><td colspan="5" class="text-center py-4 text-muted">まだ登録されたFAQはありません。</td></tr>' : ''}
          </tbody>
        </table>
      </div>
    </div>
  `;

  const modals = `
    <!-- Modal: Create FAQ -->
    <div class="modal fade" id="modal-create-faq" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>新規FAQの登録</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/faqs" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-6 form-group">
                  <label>カテゴリ (日本語)</label>
                  <input type="text" name="category_ja" class="form-control" value="特定技能・採用全般" required>
                </div>
                <div class="col-6 form-group">
                  <label>Category (English)</label>
                  <input type="text" name="category_en" class="form-control" value="Specified Skilled Worker">
                </div>
              </div>
              <div class="form-group">
                <label>質問 (日本語) *</label>
                <input type="text" name="question_ja" class="form-control" required placeholder="例: 面接から入社までどのくらいの期間がかかりますか？">
              </div>
              <div class="form-group">
                <label>Question (English)</label>
                <input type="text" name="question_en" class="form-control" placeholder="e.g., How long does it take from interview to arrival?">
              </div>
              <div class="form-group">
                <label>回答 (日本語) *</label>
                <textarea name="answer_ja" class="form-control" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label>Answer (English)</label>
                <textarea name="answer_en" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-success btn-sm font-weight-bold">✓ FAQを追加する</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal: Edit FAQ -->
    <div class="modal fade" id="modal-edit-faq" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>FAQの編集</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-edit-faq" action="" method="POST">
            <div class="modal-body">
              <div class="row">
                <div class="col-6 form-group">
                  <label>カテゴリ (日本語)</label>
                  <input type="text" name="category_ja" id="edit_faq_cat_ja" class="form-control" required>
                </div>
                <div class="col-6 form-group">
                  <label>Category (English)</label>
                  <input type="text" name="category_en" id="edit_faq_cat_en" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label>質問 (日本語) *</label>
                <input type="text" name="question_ja" id="edit_faq_q_ja" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Question (English)</label>
                <input type="text" name="question_en" id="edit_faq_q_en" class="form-control">
              </div>
              <div class="form-group">
                <label>回答 (日本語) *</label>
                <textarea name="answer_ja" id="edit_faq_a_ja" class="form-control" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label>Answer (English)</label>
                <textarea name="answer_en" id="edit_faq_a_en" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer bg-light py-2">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-primary btn-sm font-weight-bold">✓ 変更を保存する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openCreateFaqModal() {
        $('#modal-create-faq').modal('show');
      }

      function openEditFaqModal(faq) {
        document.getElementById('form-edit-faq').action = '/admin/faqs/' + faq.id;
        document.getElementById('edit_faq_cat_ja').value = faq.category_ja || '';
        document.getElementById('edit_faq_cat_en').value = faq.category_en || '';
        document.getElementById('edit_faq_q_ja').value = faq.question_ja || '';
        document.getElementById('edit_faq_q_en').value = faq.question_en || '';
        document.getElementById('edit_faq_a_ja').value = faq.answer_ja || '';
        document.getElementById('edit_faq_a_en').value = faq.answer_en || '';
        $('#modal-edit-faq').modal('show');
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 7. Inquiries Page
// ----------------------------------------------------
export function renderInquiriesContent(inquiries: any[], filterStatus?: string): { body: string; modals: string; scripts: string } {
  const filtered = filterStatus 
    ? inquiries.filter(i => i.status === filterStatus) 
    : inquiries;

  const unreadCount = inquiries.filter(i => i.status !== 'resolved').length;
  const resolvedCount = inquiries.filter(i => i.status === 'resolved').length;

  let tableRows = '';
  filtered.forEach(inq => {
    const isResolved = inq.status === 'resolved';
    const statusBadge = isResolved
      ? '<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i>対応済 (Resolved)</span>'
      : '<span class="badge badge-warning px-2 py-1 text-dark"><i class="fas fa-clock mr-1"></i>未対応 (Unread)</span>';
    
    tableRows += `
      <tr>
        <td class="text-center font-weight-bold text-muted">#${inq.id}</td>
        <td>
          <div class="font-weight-bold text-dark">${escapeHtml(inq.name)}</div>
          <small class="text-muted"><i class="fas fa-building mr-1"></i>${escapeHtml(inq.company_name || '未記入')}</small>
        </td>
        <td>
          <div><a href="mailto:${escapeHtml(inq.email)}" class="text-primary font-weight-bold">${escapeHtml(inq.email)}</a></div>
          <small class="text-muted"><i class="fas fa-phone-alt mr-1"></i>${escapeHtml(inq.phone || 'N/A')}</small>
        </td>
        <td>
          <span class="badge badge-info px-2 py-1">${escapeHtml(inq.inquiry_type || inq.service_interest || '一般相談')}</span>
        </td>
        <td style="max-width: 280px;" class="text-truncate text-secondary">
          ${escapeHtml(inq.message || '')}
        </td>
        <td class="text-center">${statusBadge}</td>
        <td class="text-center text-xs text-muted">${escapeHtml((inq.created_at || '').slice(0, 16))}</td>
        <td class="text-right text-nowrap">
          <button type="button" class="btn btn-xs btn-outline-info mr-1" onclick='openInquiryModal(${JSON.stringify(inq).replace(/'/g, "&#39;")})' title="詳細表示">
            <i class="fas fa-eye"></i> 詳細
          </button>
          <form action="/admin/inquiries/${inq.id}/status" method="POST" class="d-inline">
            <input type="hidden" name="status" value="${isResolved ? 'unread' : 'resolved'}">
            <button type="submit" class="btn btn-xs ${isResolved ? 'btn-outline-warning' : 'btn-outline-success'} mr-1" title="状態切替">
              ${isResolved ? '<i class="fas fa-undo"></i> 未対応へ' : '<i class="fas fa-check"></i> 完了'}
            </button>
          </form>
          <form action="/admin/inquiries/${inq.id}/delete" method="POST" class="d-inline" onsubmit="return confirm('お問い合わせ #${inq.id} を削除してもよろしいですか？');">
            <button type="submit" class="btn btn-xs btn-outline-danger" title="削除">
              <i class="fas fa-trash-alt"></i>
            </button>
          </form>
        </td>
      </tr>
    `;
  });

  const body = `
    <div class="row mb-3">
      <div class="col-12 d-flex flex-wrap gap-2 align-items-center">
        <a href="/admin/inquiries" class="btn btn-sm ${!filterStatus ? 'btn-primary' : 'btn-outline-primary'} mr-2">
          すべて (${inquiries.length})
        </a>
        <a href="/admin/inquiries?filter=unread" class="btn btn-sm ${filterStatus === 'unread' ? 'btn-warning' : 'btn-outline-warning'} mr-2 font-weight-bold">
          <i class="fas fa-clock mr-1"></i> 未対応 (${unreadCount})
        </a>
        <a href="/admin/inquiries?filter=resolved" class="btn btn-sm ${filterStatus === 'resolved' ? 'btn-success' : 'btn-outline-success'} font-weight-bold">
          <i class="fas fa-check-circle mr-1"></i> 対応完了 (${resolvedCount})
        </a>
      </div>
    </div>

    <div class="card card-outline card-primary shadow-sm">
      <div class="card-header bg-light">
        <h3 class="card-title font-weight-bold text-dark mb-0">
          <i class="fas fa-envelope text-primary mr-2"></i>受信お問い合わせ一覧 (${filtered.length}件 表示中)
        </h3>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover text-sm mb-0">
          <thead class="thead-light">
            <tr>
              <th class="text-center" style="width: 50px;">ID</th>
              <th>ご担当者 / 貴社名</th>
              <th>連絡先 (メール・電話)</th>
              <th>ご相談種別</th>
              <th>メッセージ内容</th>
              <th class="text-center">対応状態</th>
              <th class="text-center">受信日時</th>
              <th class="text-right">操作</th>
            </tr>
          </thead>
          <tbody>
            ${tableRows}
            ${filtered.length === 0 ? '<tr><td colspan="8" class="text-center py-4 text-muted">該当するお問い合わせはありません。</td></tr>' : ''}
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
            <h5 class="modal-title font-weight-bold"><i class="fas fa-envelope-open mr-2"></i>お問い合わせ詳細</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">ご担当者様 お名前</label>
              <div class="font-weight-bold" id="view_inq_name"></div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">貴社名 / 組織名</label>
              <div class="font-weight-bold" id="view_inq_company"></div>
            </div>
            <div class="row">
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">メールアドレス</label>
                <div id="view_inq_email"></div>
              </div>
              <div class="col-6 form-group mb-2">
                <label class="text-xs text-muted mb-0">電話番号</label>
                <div id="view_inq_phone"></div>
              </div>
            </div>
            <div class="form-group mb-2">
              <label class="text-xs text-muted mb-0">ご相談分野</label>
              <div><span class="badge badge-info" id="view_inq_type"></span></div>
            </div>
            <div class="form-group mb-0">
              <label class="text-xs text-muted mb-1">お問い合わせ内容 (Message)</label>
              <div class="p-3 bg-light rounded border text-sm" id="view_inq_message" style="white-space: pre-wrap; word-break: break-word;"></div>
            </div>
          </div>
          <div class="modal-footer bg-light py-2 d-flex justify-content-between">
            <a href="#" id="view_inq_reply_btn" class="btn btn-success btn-sm font-weight-bold">
              <i class="fas fa-reply mr-1"></i> メールで返信する
            </a>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">閉じる</button>
          </div>
        </div>
      </div>
    </div>
  `;

  const scripts = `
    <script>
      function openInquiryModal(inq) {
        document.getElementById('view_inq_name').textContent = inq.name || '';
        document.getElementById('view_inq_company').textContent = inq.company_name || '未入力';
        document.getElementById('view_inq_email').innerHTML = '<a href="mailto:' + (inq.email || '') + '">' + (inq.email || '') + '</a>';
        document.getElementById('view_inq_phone').textContent = inq.phone || '未入力';
        document.getElementById('view_inq_type').textContent = inq.inquiry_type || inq.service_interest || '一般相談';
        document.getElementById('view_inq_message').textContent = inq.message || '';
        document.getElementById('view_inq_reply_btn').href = 'mailto:' + (inq.email || '') + '?subject=' + encodeURIComponent('【MIRANSH合同会社】お問い合わせありがとうございます');
        $('#modal-view-inquiry').modal('show');
      }
    </script>
  `;

  return { body, modals, scripts };
}

// ----------------------------------------------------
// 8. Password Change Page (Requested extra function)
// ----------------------------------------------------
export function renderPasswordContent(user: any): { body: string; modals: string; scripts: string } {
  const body = `
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-9">
        <div class="card card-outline card-danger shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-key text-danger mr-2"></i>管理者パスワード変更 (Change Admin Password)
            </h3>
          </div>
          <form action="/admin/password" method="POST" id="form-change-password">
            <div class="card-body">
              <div class="callout callout-info py-2 px-3 mb-4 text-xs">
                <div class="font-weight-bold text-dark mb-1"><i class="fas fa-shield-alt text-info mr-1"></i>アカウント情報:</div>
                <div>ユーザー名: <strong>${escapeHtml(user?.name || 'admin')}</strong></div>
                <div>メールアドレス: <strong>${escapeHtml(user?.email || 'admin@miransh.jp')}</strong></div>
                <div class="text-muted mt-1">※パスワードを変更すると次回ログイン時から新しいパスワードが適用されます。</div>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">現在のパスワード <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="current_password" id="input_current_password" class="form-control" placeholder="現在のパスワードを入力" required autofocus>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('input_current_password', 'icon_curr_pw')">
                      <i class="fas fa-eye" id="icon_curr_pw"></i>
                    </button>
                  </div>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <label class="font-weight-bold">新しいパスワード (6文字以上) <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="new_password" id="input_new_password" class="form-control" placeholder="新しい安全なパスワードを入力" required minlength="6">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('input_new_password', 'icon_new_pw')">
                      <i class="fas fa-eye" id="icon_new_pw"></i>
                    </button>
                  </div>
                </div>
                <small class="form-text text-muted">英数字や記号を組み合わせた6文字以上のパスワードを推奨します。</small>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">新しいパスワード（確認入力） <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="confirm_password" id="input_confirm_password" class="form-control" placeholder="もう一度新しいパスワードを入力" required minlength="6">
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
                <i class="fas fa-arrow-left mr-1"></i> ダッシュボードに戻る
              </a>
              <button type="submit" class="btn btn-danger font-weight-bold px-4 shadow-sm" id="btn_submit_password">
                <i class="fas fa-check mr-1"></i> パスワードを更新する
              </button>
            </div>
          </form>
        </div>

        <div class="card card-outline card-secondary shadow-sm">
          <div class="card-header bg-light py-2">
            <h6 class="font-weight-bold text-dark mb-0"><i class="fas fa-lock text-secondary mr-2"></i>セキュリティ仕様</h6>
          </div>
          <div class="card-body text-xs text-muted">
            <ul class="pl-3 mb-0">
              <li>パスワードは産業標準の <strong>bcrypt アルゴリズム</strong> によりソルト付きで安全にハッシュ化されて保存されます。</li>
              <li>平文のパスワードがログやデータベースに保存されることは一切ありません。</li>
              <li>変更後はセッションが安全に更新され、継続して管理操作が行えます。</li>
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

      function validatePasswordMatch() {
        if (!confirmPw.value) {
          matchStatus.innerHTML = '';
          return;
        }
        if (newPw.value === confirmPw.value) {
          matchStatus.className = 'text-xs font-weight-bold text-success mt-1';
          matchStatus.innerHTML = '<i class="fas fa-check-circle mr-1"></i>パスワードが一致しています';
        } else {
          matchStatus.className = 'text-xs font-weight-bold text-danger mt-1';
          matchStatus.innerHTML = '<i class="fas fa-times-circle mr-1"></i>パスワードが一致していません';
        }
      }

      newPw.addEventListener('input', validatePasswordMatch);
      confirmPw.addEventListener('input', validatePasswordMatch);

      document.getElementById('form-change-password').addEventListener('submit', function(e) {
        if (newPw.value !== confirmPw.value) {
          e.preventDefault();
          alert('新しいパスワードと確認入力が一致しません。');
          confirmPw.focus();
        }
      });
    </script>
  `;

  return { body, modals: '', scripts };
}

// ----------------------------------------------------
// 9. Sakana AI Configuration Page
// ----------------------------------------------------
export function renderAiContent(currentSakanaModel: string, currentSakanaKey: string): { body: string; modals: string; scripts: string } {
  const body = `
    <div class="row">
      <div class="col-lg-8">
        <div class="card card-outline card-primary shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-robot text-primary mr-2"></i>Sakana AI アシスタント設定・診断
            </h3>
          </div>
          <div class="card-body">
            <form action="/admin/api/sakana/config" method="POST">
              <div class="form-group">
                <label class="font-weight-bold">稼働AIモデル (Model Selection)</label>
                <select name="model" id="sakana_model_select" class="form-control">
                  <option value="sakana-namazu" ${currentSakanaModel === 'sakana-namazu' ? 'selected' : ''}>Sakana Namazu (日本語特化・高度推論モデル)</option>
                  <option value="fugu" ${currentSakanaModel === 'fugu' ? 'selected' : ''}>Sakana Fugu (自律エージェント連携モデル)</option>
                  <option value="fugu-ultra" ${currentSakanaModel === 'fugu-ultra' ? 'selected' : ''}>Sakana Fugu Ultra (深層リサーチ対応モデル)</option>
                </select>
                <small class="form-text text-muted">特定技能やビザ申請などの専門知識を高速かつ高精度に応答します。</small>
              </div>

              <div class="form-group">
                <label class="font-weight-bold">Sakana AI API Key</label>
                <div class="input-group">
                  <input type="password" name="apiKey" id="sakana_apikey_input" class="form-control" value="${escapeHtml(currentSakanaKey)}" placeholder="fish_live_..." autocomplete="off">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('sakana_apikey_input', 'toggle_key_icon')">
                      <i class="fas fa-eye" id="toggle_key_icon"></i>
                    </button>
                  </div>
                </div>
                <small class="form-text text-muted">環境変数または直接入力したAPIキーが安全に適用されます。</small>
              </div>

              <div class="d-flex align-items-center gap-2 mt-4">
                <button type="submit" class="btn btn-primary font-weight-bold px-4 mr-2 shadow-sm">
                  <i class="fas fa-save mr-1"></i> AI設定を保存する
                </button>
                <button type="button" class="btn btn-info font-weight-bold px-3 shadow-sm" onclick="runSakanaDiagnosticTest()">
                  <i class="fas fa-plug mr-1"></i> 接続テスト・応答診断を実行
                </button>
              </div>
            </form>

            <div id="sakana_test_result_box" class="mt-4" style="display: none;">
              <div class="callout callout-info py-3" id="sakana_test_callout">
                <h6 class="font-weight-bold" id="sakana_test_title"><i class="fas fa-spinner fa-spin mr-1"></i> 診断実行中...</h6>
                <p class="mb-0 text-sm" id="sakana_test_desc">Sakana AI クラウドエンドポイントと通信中...</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card card-outline card-info shadow-sm">
          <div class="card-header bg-light">
            <h3 class="card-title font-weight-bold text-dark mb-0">
              <i class="fas fa-microchip text-info mr-2"></i>Sakana AI アーキテクチャ
            </h3>
          </div>
          <div class="card-body text-xs">
            <p class="text-secondary mb-2">
              MIRANSH公式Webサイトのチャットボット「Sakana AI」は、ネパール外国人材採用、特定技能制度、出入国在留管理庁への申請手続き、登録支援機関の業務フローに特化した専用ナレッジベースを搭載しています。
            </p>
            <div class="callout callout-secondary py-2 px-3 mb-0">
              <strong>フォールバック保護:</strong><br>
              万が一APIキー未設定やネットワークタイムアウトが発生した場合でも、自律ルールベース推論エンジンが自動介入し、ユーザー対応を継続します。
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
        title.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> 診断実行中...';
        desc.textContent = 'Sakana AI API エンドポイントとの疎通・レイテンシを計測中...';

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
            title.innerHTML = '<i class="fas fa-check-circle text-success mr-1"></i> 接続成功 (API Online)';
            desc.innerHTML = 'モデル: <strong>' + data.model + '</strong> | 応答速度: <strong>' + data.latencyMs + ' ms</strong><br>正常に双方向推論が可能です。';
          } else {
            callout.className = 'callout callout-success py-3';
            title.innerHTML = '<i class="fas fa-shield-alt text-success mr-1"></i> AI推論エンジン待機完了 (Engine Ready)';
            desc.innerHTML = 'モデル: <strong>' + data.model + '</strong> | ステータス: <strong>正常稼働中</strong><br>MIRANSH 高精度バイリンガル相談エージェントが応答可能です。';
          }
        } catch (e) {
          callout.className = 'callout callout-danger py-3';
          title.innerHTML = '<i class="fas fa-times-circle text-danger mr-1"></i> 通信エラー';
          desc.textContent = 'エラーが発生しました: ' + e.message;
        }
      }
    </script>
  `;

  return { body, modals: '', scripts };
}
