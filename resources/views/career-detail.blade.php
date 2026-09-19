<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vacancy->title_ja }} ({{ $vacancy->job_code }}) | 自社採用情報 - MIRANSH合同会社</title>
    <meta name="description" content="MIRANSH合同会社 本社（自社雇用）の求人票：{{ $vacancy->title_ja }}（{{ $vacancy->job_code }}）。雇用形態：正社員、勤務地：{{ $vacancy->location_ja }}。詳しい仕事内容・応募資格・給与条件・福利厚生を掲載中。">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://miransh.co.jp/careers/{{ $vacancy->job_code }}">

    <!-- Open Graph Protocol -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://miransh.co.jp/careers/{{ $vacancy->job_code }}">
    <meta property="og:title" content="{{ $vacancy->title_ja }} ({{ $vacancy->job_code }}) | MIRANSH合同会社">
    <meta property="og:description" content="MIRANSH合同会社 本社直接雇用求人：{{ $vacancy->title_ja }}。募集要項および簡単WEBエントリー受付中。">
    <meta property="og:image" content="https://miransh.co.jp/images/logo-icon.png">
    <meta property="og:site_name" content="MIRANSH合同会社 (MIRANSH LLC)">
    <meta property="og:locale" content="ja_JP">

    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" type="image/png" href="/images/logo-icon.png">
    <style>
        .spec-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #CBD5E1;
        }
        .spec-table th {
            width: 28%;
            background: #F8FAFC;
            color: #1E293B;
            font-weight: 700;
            padding: 14px 18px;
            border-bottom: 1px solid #E2E8F0;
            text-align: left;
            vertical-align: top;
            font-size: 14px;
        }
        .spec-table td {
            padding: 14px 18px;
            border-bottom: 1px solid #E2E8F0;
            color: #334155;
            font-size: 14px;
            line-height: 1.6;
        }
        .spec-table tr:last-child th,
        .spec-table tr:last-child td {
            border-bottom: none;
        }
        @media (max-width: 768px) {
            .spec-table th, .spec-table td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
            .spec-table th {
                background: #F1F5F9;
                border-bottom: none;
                padding-bottom: 4px;
            }
        }
    </style>
</head>
<body class="ja">

    <!-- Header -->
    <header>
        <div class="container navbar">
            <a href="/" class="brand-wrapper">
                <img src="/images/logo-icon.png" alt="MIRANSH LLC" class="brand-logo-img">
                <div>
                    <div class="brand-title">
                        <span class="lang-ja">{{ $company->name_ja ?? 'MIRANSH合同会社' }}</span>
                        <span class="lang-en">{{ $company->name_en ?? 'MIRANSH LLC' }}</span>
                    </div>
                    <div class="brand-subtitle">
                        <span class="lang-ja">ミランス合同会社 | 国際人材ソリューション</span>
                        <span class="lang-en">Global Talent & Corporate Bridge</span>
                    </div>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="/#about" class="nav-link"><span class="lang-ja">会社紹介</span><span class="lang-en">About</span></a></li>
                <li><a href="/#services" class="nav-link"><span class="lang-ja">事業内容</span><span class="lang-en">Services</span></a></li>
                <li><a href="/#stories" class="nav-link"><span class="lang-ja">採用事例</span><span class="lang-en">Stories</span></a></li>
                <li><a href="/careers" class="nav-link active" style="color: #0E7490; font-weight: 700;"><span class="lang-ja">自社採用</span><span class="lang-en">Careers</span></a></li>
                <li><a href="/#contact" class="nav-link"><span class="lang-ja">お問い合わせ</span><span class="lang-en">Contact</span></a></li>
            </ul>

            <div class="nav-right-actions">
                <div class="lang-toggle-group">
                    <button type="button" class="lang-btn active" id="btn-lang-ja" onclick="setLanguage('ja')">日本語</button>
                    <button type="button" class="lang-btn" id="btn-lang-en" onclick="setLanguage('en')">EN</button>
                </div>
                <a href="#apply-form" class="btn-header-cta">
                    <span class="lang-ja">応募する</span>
                    <span class="lang-en">Apply Now</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div style="background: #F1F5F9; border-bottom: 1px solid #E2E8F0; padding: 12px 0; font-size: 13px;">
        <div class="container" style="display: flex; gap: 8px; align-items: center; color: #64748B;">
            <a href="/" style="color: #0E7490; text-decoration: none;">ホーム</a>
            <span>/</span>
            <a href="/careers" style="color: #0E7490; text-decoration: none;">自社採用情報</a>
            <span>/</span>
            <span style="color: #1E293B; font-weight: 600;">{{ $vacancy->job_code }}</span>
        </div>
    </div>

    <!-- Main Content Area -->
    <div style="padding: 48px 0; background: #F8FAFC;">
        <div class="container" style="display: grid; grid-template-columns: 1fr 340px; gap: 36px; align-items: start;">
            
            <!-- Left Main Column -->
            <div>
                <!-- Job Header Card -->
                <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 32px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-bottom: 12px;">
                        <span style="font-family: monospace; font-size: 13px; font-weight: 700; background: #0F172A; color: #FFFFFF; padding: 4px 10px; border-radius: 4px;">{{ $vacancy->job_code }}</span>
                        <span style="font-size: 13px; font-weight: 700; background: #0E7490; color: #FFFFFF; padding: 4px 12px; border-radius: 9999px;">
                            @if($vacancy->employment_type === 'full_time') 正社員（総合職）
                            @elseif($vacancy->employment_type === 'contract') 契約社員
                            @elseif($vacancy->employment_type === 'part_time') パート・アルバイト
                            @else インターンシップ @endif
                        </span>
                        <span style="font-size: 13px; color: #047857; font-weight: 700; background: #ECFDF5; border: 1px solid #A7F3D0; padding: 4px 10px; border-radius: 4px;">
                            ● 積極募集中 (Actively Hiring)
                        </span>
                    </div>

                    <h1 style="font-size: 26px; font-weight: 900; line-height: 1.35; color: #0F172A; margin: 0 0 8px 0;">
                        {{ $vacancy->title_ja }}
                    </h1>
                    <div style="font-size: 16px; color: #64748B; font-weight: 500; margin-bottom: 20px;">
                        {{ $vacancy->title_en }}
                    </div>

                    <div style="background: #FEF3C7; border: 1px solid #F59E0B; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #92400E; line-height: 1.6;">
                        <strong>【MIRANSH合同会社 自社直接雇用】</strong><br>
                        本求人はMIRANSH合同会社 東京本社での正規雇用募集です。クライアント企業様への紹介ではなく、当社自社の事業（外国人材マッチング、在留資格申請手続き、登録支援機関業務）を推進するコアメンバーとしての採用となります。
                    </div>
                </div>

                <!-- Job Overview / Description -->
                @if(!empty($vacancy->description_ja))
                    <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 32px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0 0 16px 0; border-left: 4px solid #0E7490; padding-left: 12px;">
                            募集背景・ポジションの役割
                        </h2>
                        <div style="font-size: 14px; line-height: 1.8; color: #334155; white-space: pre-line;">
                            {{ $vacancy->description_ja }}
                        </div>
                    </div>
                @endif

                <!-- Job Specifications Table -->
                <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 32px;">
                    <h2 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0 0 16px 0; border-left: 4px solid #0E7490; padding-left: 12px;">
                        求人票 / 募集要項
                    </h2>

                    @php
                        $salaryFormatted = '';
                        if ($vacancy->salary_min && $vacancy->salary_max) {
                            $salaryFormatted = '月給 ' . number_format($vacancy->salary_min) . '円 〜 ' . number_format($vacancy->salary_max) . '円';
                        } else if ($vacancy->salary_min) {
                            $salaryFormatted = '月給 ' . number_format($vacancy->salary_min) . '円〜';
                        }
                    @endphp

                    <table class="spec-table">
                        <tbody>
                            <tr>
                                <th>求人番号 / 職種名</th>
                                <td>
                                    <strong>{{ $vacancy->job_code }}</strong><br>
                                    {{ $vacancy->title_ja }}<br>
                                    <span style="color: #64748B; font-size: 13px;">({{ $vacancy->title_en }})</span>
                                </td>
                            </tr>
                            <tr>
                                <th>雇用形態</th>
                                <td>
                                    @if($vacancy->employment_type === 'full_time') 正社員（試用期間あり：3ヶ月・条件変更なし）
                                    @elseif($vacancy->employment_type === 'contract') 契約社員（正社員登用制度あり）
                                    @elseif($vacancy->employment_type === 'part_time') パート・アルバイト
                                    @else インターンシップ @endif
                                </td>
                            </tr>
                            <tr>
                                <th>勤務地</th>
                                <td>
                                    <strong>{{ $vacancy->location_ja }}</strong><br>
                                    <span style="color: #64748B; font-size: 13px;">{{ $vacancy->location_en }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>給与・報酬</th>
                                <td>
                                    <div style="font-size: 18px; font-weight: 800; color: #047857;">
                                        {{ $salaryFormatted ?: '経験・能力を考慮の上決定' }}
                                    </div>
                                    @if(!empty($vacancy->salary_note_ja))
                                        <div style="font-size: 13px; color: #475569; margin-top: 4px;">
                                            {{ $vacancy->salary_note_ja }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>勤務時間</th>
                                <td>
                                    {{ $vacancy->working_hours_ja ?: '9:00 〜 18:00（実働8時間、休憩60分）' }}
                                </td>
                            </tr>
                            <tr>
                                <th>休日・休暇</th>
                                <td>
                                    {{ $vacancy->holidays_ja ?: '完全週休2日制（土曜日・日曜日）、祝日、年末年始休暇、年次有給休暇' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Responsibilities (仕事内容) -->
                @if($vacancy->responsibilities && $vacancy->responsibilities->count() > 0)
                    <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 32px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0 0 16px 0; border-left: 4px solid #0E7490; padding-left: 12px;">
                            具体的な仕事内容
                        </h2>
                        <div style="display: grid; gap: 16px;">
                            @foreach($vacancy->responsibilities as $index => $resp)
                                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 18px;">
                                    <div style="display: flex; align-items: baseline; gap: 8px; margin-bottom: 6px;">
                                        <span style="font-size: 14px; font-weight: 800; color: #0E7490;">{{ $index + 1 }}.</span>
                                        <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">
                                            {{ $resp->title_ja }}
                                        </h3>
                                    </div>
                                    @if(!empty($resp->title_en) && $resp->title_en !== $resp->title_ja)
                                        <div style="font-size: 12px; color: #64748B; margin-bottom: 8px; margin-left: 20px;">
                                            {{ $resp->title_en }}
                                        </div>
                                    @endif
                                    @if(!empty($resp->description_ja))
                                        <p style="font-size: 14px; color: #475569; line-height: 1.7; margin: 0; margin-left: 20px; white-space: pre-line;">
                                            {{ $resp->description_ja }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Requirements (応募資格・要件) -->
                @if($vacancy->requirements && $vacancy->requirements->count() > 0)
                    <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 32px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0 0 16px 0; border-left: 4px solid #0E7490; padding-left: 12px;">
                            応募資格・要件
                        </h2>

                        <!-- Required -->
                        @php $requiredList = $vacancy->requirements->where('type', 'required'); @endphp
                        @if($requiredList->count() > 0)
                            <div style="margin-bottom: 24px;">
                                <div style="display: inline-flex; align-items: center; gap: 6px; background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; padding: 4px 12px; border-radius: 4px; font-size: 13px; font-weight: 700; margin-bottom: 12px;">
                                    <span>✓</span> 必須要件 (Required Qualifications)
                                </div>
                                <ul style="margin: 0; padding-left: 24px; line-height: 1.8; color: #1E293B; font-size: 14px;">
                                    @foreach($requiredList as $req)
                                        <li style="margin-bottom: 8px;">
                                            <strong>{{ $req->description_ja }}</strong>
                                            @if(!empty($req->description_en))
                                                <div style="font-size: 12px; color: #64748B;">{{ $req->description_en }}</div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Preferred -->
                        @php $preferredList = $vacancy->requirements->where('type', 'preferred'); @endphp
                        @if($preferredList->count() > 0)
                            <div>
                                <div style="display: inline-flex; align-items: center; gap: 6px; background: #F8FAFC; color: #475569; border: 1px solid #CBD5E1; padding: 4px 12px; border-radius: 4px; font-size: 13px; font-weight: 700; margin-bottom: 12px;">
                                    <span>★</span> 歓迎要件・求める人物像 (Preferred Skills)
                                </div>
                                <ul style="margin: 0; padding-left: 24px; line-height: 1.8; color: #334155; font-size: 14px;">
                                    @foreach($preferredList as $req)
                                        <li style="margin-bottom: 8px;">
                                            {{ $req->description_ja }}
                                            @if(!empty($req->description_en))
                                                <div style="font-size: 12px; color: #64748B;">{{ $req->description_en }}</div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Benefits & Perks (福利厚生・サポート) -->
                @if($vacancy->benefits && $vacancy->benefits->count() > 0)
                    <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 32px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0 0 16px 0; border-left: 4px solid #0E7490; padding-left: 12px;">
                            福利厚生・待遇・職場環境
                        </h2>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                            @foreach($vacancy->benefits as $b)
                                <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; padding: 16px;">
                                    <h3 style="font-size: 15px; font-weight: 800; color: #166534; margin: 0 0 6px 0; display: flex; align-items: center; gap: 6px;">
                                        <span>🎁</span> {{ $b->title_ja }}
                                    </h3>
                                    @if(!empty($b->title_en))
                                        <div style="font-size: 12px; color: #15803D; margin-bottom: 6px;">{{ $b->title_en }}</div>
                                    @endif
                                    @if(!empty($b->description_ja))
                                        <p style="font-size: 13px; color: #374151; margin: 0; line-height: 1.6;">
                                            {{ $b->description_ja }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Application Form Section -->
                <div id="apply-form" style="background: #FFFFFF; border: 2px solid #0E7490; border-radius: 12px; padding: 36px; box-shadow: 0 10px 25px -5px rgba(14, 116, 144, 0.1); margin-bottom: 32px;">
                    <div style="text-align: center; margin-bottom: 24px;">
                        <span style="font-size: 12px; font-weight: 700; background: #0E7490; color: #FFFFFF; padding: 4px 12px; border-radius: 9999px;">ENTRY FORM</span>
                        <h2 style="font-size: 24px; font-weight: 900; color: #0F172A; margin: 8px 0 6px 0;">
                            この求人にWEB応募する
                        </h2>
                        <p style="font-size: 14px; color: #64748B; margin: 0;">
                            下記フォームに必要事項をご入力の上、送信してください。採用担当者より数日以内にご連絡いたします。
                        </p>
                    </div>

                    @if(session('success'))
                        <div style="background: #ECFDF5; border: 1px solid #10B981; border-radius: 8px; padding: 16px; margin-bottom: 24px; color: #065F46; font-size: 14px; line-height: 1.6;">
                            <strong>✓ 送信完了:</strong> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('careers.apply') }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                        @csrf
                        <input type="hidden" name="job_code" value="{{ $vacancy->job_code }}">

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">お名前 (氏名) <span style="color: #DC2626;">*</span></label>
                                <input type="text" name="applicant_name" required placeholder="山田 太郎 / RAM GIRI" style="width: 100%; padding: 11px 14px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">フリガナ (カタカナまたはローマ字)</label>
                                <input type="text" name="name_kana" placeholder="ヤマダ タロウ" style="width: 100%; padding: 11px 14px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">メールアドレス <span style="color: #DC2626;">*</span></label>
                                <input type="email" name="email" required placeholder="sample@example.com" style="width: 100%; padding: 11px 14px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">電話番号</label>
                                <input type="tel" name="phone" placeholder="090-1234-5678" style="width: 100%; padding: 11px 14px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">日本語能力 (JLPT)</label>
                                <select name="japanese_level" style="width: 100%; padding: 11px 14px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 14px; background: #FFFFFF; box-sizing: border-box;">
                                    <option value="Native / 日本語母語話者">Native / 日本語母語話者</option>
                                    <option value="N1 合格">N1 合格</option>
                                    <option value="N2 合格" selected>N2 合格</option>
                                    <option value="N3 合格">N3 合格</option>
                                    <option value="N4 / N5 / 勉強中">N4 / N5 / 勉強中</option>
                                    <option value="BJT 400点以上">BJT 400点以上</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">在留資格 / 現在の状況</label>
                                <input type="text" name="residence_status" placeholder="例: 留学中, 就労中 (技術・人文知識・国際業務)" style="width: 100%; padding: 11px 14px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                            </div>
                        </div>

                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">志望動機・自己PR・これまでの経験</label>
                            <textarea name="cover_letter" rows="4" placeholder="これまでの職歴、語学力（英語・ネパール語・日本語など）、パソコンスキル（Excelなど）、希望入社時期などをご記入ください。" style="width: 100%; padding: 12px 14px; border: 1px solid #CBD5E1; border-radius: 6px; font-size: 14px; box-sizing: border-box;"></textarea>
                        </div>

                        <button type="submit" class="btn-primary" style="padding: 14px 28px; font-size: 16px; font-weight: 800; justify-content: center; margin-top: 8px;">
                            <span>MIRANSH採用担当に応募エントリーを送信する</span>
                            <span>→</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Sidebar Column -->
            <div>
                <!-- Employer Card -->
                <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 24px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <img src="/images/logo-icon.png" alt="MIRANSH" style="width: 44px; height: 44px; border-radius: 8px;">
                        <div>
                            <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">{{ $company->name_ja ?? 'MIRANSH合同会社' }}</h3>
                            <div style="font-size: 12px; color: #64748B;">MIRANSH LLC (Tokyo HQ)</div>
                        </div>
                    </div>

                    <div style="font-size: 13px; color: #475569; line-height: 1.7; margin-bottom: 16px;">
                        〒184-0011<br>
                        東京都小金井市東町4丁目8番14号<br>
                        アクトレジデンス新小金井201号室<br>
                        TEL: {{ $company->phone ?? '042-409-8256' }}<br>
                        有料職業紹介事業許可：13-ユ-319558
                    </div>

                    <a href="/#company" style="font-size: 13px; color: #0E7490; font-weight: 700; text-decoration: none;">
                        会社概要・代表挨拶を見る →
                    </a>
                </div>

                <!-- Other Open Positions -->
                @if(isset($otherVacancies) && $otherVacancies->count() > 0)
                    <div style="background: #FFFFFF; border: 1px solid #CBD5E1; border-radius: 12px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <h3 style="font-size: 15px; font-weight: 800; color: #0F172A; margin: 0 0 16px 0;">その他の自社求人</h3>
                        <div style="display: grid; gap: 12px;">
                            @foreach($otherVacancies as $ov)
                                <a href="/careers/{{ $ov->job_code }}" style="text-decoration: none; padding: 12px; border: 1px solid #E2E8F0; border-radius: 8px; display: block; transition: background 0.15s ease;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='#FFFFFF'">
                                    <span style="font-family: monospace; font-size: 11px; background: #0F172A; color: #FFFFFF; padding: 2px 6px; border-radius: 4px;">{{ $ov->job_code }}</span>
                                    <div style="font-size: 13px; font-weight: 700; color: #1E293B; margin-top: 4px;">{{ $ov->title_ja }}</div>
                                </a>
                            @endforeach
                        </div>
                        <a href="/careers" style="display: block; text-align: center; margin-top: 16px; font-size: 13px; color: #0E7490; font-weight: 700; text-decoration: none;">
                            全求人一覧を見る →
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-bottom">
            <div>&copy; {{ date('Y') }} MIRANSH合同会社 (MIRANSH LLC). All Rights Reserved.</div>
            <div style="font-size: 12px; color: #64748B; margin-top: 6px;">有料職業紹介事業許可：13-ユ-319558 | 東京都小金井市東町4丁目8番14号</div>
        </div>
    </footer>

    <script src="/js/app.js"></script>
</body>
</html>
