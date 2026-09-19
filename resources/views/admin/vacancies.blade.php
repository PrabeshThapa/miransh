@php
    $currLang = strtolower(request()->query('lang', request()->cookie('admin_lang', session('admin_lang', 'ja'))));
    if (!in_array($currLang, ['ja', 'en'])) $currLang = 'ja';
    $isEn = ($currLang === 'en');
@endphp

@extends('layouts.adminlte')

@section('title', $isEn ? 'Job Vacancies Management' : '自社求人情報管理')
@section('page_title', $isEn ? 'Internal Job Vacancies Management' : '自社求人情報管理 (Job Vacancies)')

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ $isEn ? 'Job Vacancies' : '自社求人情報管理' }}</li>
@endsection

@section('content')
<!-- Statistics Summary Widgets -->
<div class="row mb-3">
    <div class="col-6 col-md-3">
        <div class="small-box bg-info elevation-1 mb-2">
            <div class="inner p-3">
                <h3 class="font-weight-bold mb-1">{{ $totalCount ?? $vacancies->count() }}</h3>
                <p class="mb-0 text-sm">{{ $isEn ? 'Total Positions' : '登録求人総数' }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-briefcase"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="small-box bg-success elevation-1 mb-2">
            <div class="inner p-3">
                <h3 class="font-weight-bold mb-1">{{ $publishedCount ?? 0 }}</h3>
                <p class="mb-0 text-sm">{{ $isEn ? 'Published & Active' : '公開中・募集中' }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="small-box bg-warning elevation-1 mb-2">
            <div class="inner p-3">
                <h3 class="font-weight-bold mb-1 text-dark">{{ $draftCount ?? 0 }}</h3>
                <p class="mb-0 text-sm text-dark">{{ $isEn ? 'Drafts / Preparing' : '下書き・非公開' }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-pencil-alt"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="small-box bg-secondary elevation-1 mb-2">
            <div class="inner p-3">
                <h3 class="font-weight-bold mb-1">{{ $closedCount ?? 0 }}</h3>
                <p class="mb-0 text-sm">{{ $isEn ? 'Closed Positions' : '募集終了・アーカイブ' }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-archive"></i>
            </div>
        </div>
    </div>
</div>

<div class="card card-outline card-primary shadow-sm">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center py-2">
        <h3 class="card-title font-weight-bold mb-0">
            <i class="fas fa-user-tie text-primary mr-2"></i>{{ $isEn ? 'Company Internal Vacancies' : '自社採用・求人一覧 (MIRANSH Headquarters)' }}
        </h3>
        <div class="card-tools d-flex align-items-center">
            <a href="/careers" target="_blank" class="btn btn-sm btn-outline-info mr-2 shadow-xs" title="{{ $isEn ? 'View Public Careers Portal' : '公開採用サイトをプレビュー' }}">
                <i class="fas fa-external-link-alt mr-1"></i> {{ $isEn ? 'Public Careers Portal' : '公開求人ページ' }}
            </a>
            <button type="button" class="btn btn-sm btn-success shadow-xs font-weight-bold" onclick="openCreateVacancyModal()">
                <i class="fas fa-plus mr-1"></i> {{ $isEn ? 'Add Vacancy' : '新規求人を登録' }}
            </button>
        </div>
    </div>

    <!-- Filter & Search Controls -->
    <div class="card-body border-bottom bg-light py-2 px-3">
        <form method="GET" action="{{ route('admin.vacancies') }}" class="form-row align-items-center">
            <input type="hidden" name="lang" value="{{ $currLang }}">
            <div class="col-auto">
                <div class="btn-group btn-group-sm">
                    <a href="{{ route('admin.vacancies', ['lang' => $currLang]) }}" class="btn btn-outline-secondary {{ !request()->filled('status') ? 'active font-weight-bold' : '' }}">
                        {{ $isEn ? 'All Status' : 'すべて' }}
                    </a>
                    <a href="{{ route('admin.vacancies', ['status' => 'published', 'lang' => $currLang]) }}" class="btn btn-outline-success {{ request()->query('status') === 'published' ? 'active font-weight-bold' : '' }}">
                        {{ $isEn ? 'Published' : '公開中' }}
                    </a>
                    <a href="{{ route('admin.vacancies', ['status' => 'draft', 'lang' => $currLang]) }}" class="btn btn-outline-warning {{ request()->query('status') === 'draft' ? 'active font-weight-bold' : '' }}">
                        {{ $isEn ? 'Draft' : '下書き' }}
                    </a>
                    <a href="{{ route('admin.vacancies', ['status' => 'closed', 'lang' => $currLang]) }}" class="btn btn-outline-secondary {{ request()->query('status') === 'closed' ? 'active font-weight-bold' : '' }}">
                        {{ $isEn ? 'Closed' : '募集終了' }}
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 my-1">
                <div class="input-group input-group-sm">
                    <input type="text" name="q" value="{{ request()->query('q') }}" class="form-control" placeholder="{{ $isEn ? 'Search code, title, location...' : '求人番号・職種・勤務地で検索...' }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            @if(request()->filled('q') || request()->filled('status'))
                <div class="col-auto">
                    <a href="{{ route('admin.vacancies', ['lang' => $currLang]) }}" class="btn btn-sm btn-link text-muted">
                        {{ $isEn ? 'Reset Filter' : '絞り込み解除' }}
                    </a>
                </div>
            @endif
        </form>
    </div>

    <div class="card-body p-0">
        @if($vacancies->isEmpty())
            <div class="text-center py-5 text-muted">
                <div style="font-size: 48px;" class="mb-2">💼</div>
                <h5 class="font-weight-bold text-dark">{{ $isEn ? 'No Job Vacancies Found' : '求人情報が見つかりません' }}</h5>
                <p class="text-sm mb-3">{{ $isEn ? 'Create your first internal job vacancy position for MIRANSH headquarters.' : 'MIRANSH合同会社本社の自社求人情報を新規登録してください。' }}</p>
                <button type="button" class="btn btn-primary btn-sm" onclick="openCreateVacancyModal()">
                    <i class="fas fa-plus mr-1"></i> {{ $isEn ? 'Add First Vacancy' : '新規求人を登録する' }}
                </button>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="thead-light text-nowrap">
                        <tr>
                            <th style="width: 120px;">{{ $isEn ? 'Job Code' : '求人番号' }}</th>
                            <th>{{ $isEn ? 'Position Title (JA / EN)' : '職種・募集ポジション' }}</th>
                            <th style="width: 110px;">{{ $isEn ? 'Type' : '雇用形態' }}</th>
                            <th>{{ $isEn ? 'Location / Salary' : '勤務地 / 給与' }}</th>
                            <th style="width: 120px;" class="text-center">{{ $isEn ? 'Status' : 'ステータス' }}</th>
                            <th style="width: 60px;" class="text-center">{{ $isEn ? 'Order' : '順序' }}</th>
                            <th style="width: 160px;" class="text-right">{{ $isEn ? 'Actions' : '操作' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacancies as $v)
                            @php
                                $statusBadgeClass = 'badge-secondary';
                                $statusLabelJa = '募集終了';
                                $statusLabelEn = 'Closed';
                                if ($v->status === 'published') {
                                    $statusBadgeClass = 'badge-success';
                                    $statusLabelJa = '公開中';
                                    $statusLabelEn = 'Published';
                                } else if ($v->status === 'draft') {
                                    $statusBadgeClass = 'badge-warning text-dark';
                                    $statusLabelJa = '下書き';
                                    $statusLabelEn = 'Draft';
                                }

                                $empBadge = 'badge-primary';
                                $empLabelJa = '正社員';
                                $empLabelEn = 'Full-time';
                                if ($v->employment_type === 'contract') {
                                    $empBadge = 'badge-info';
                                    $empLabelJa = '契約社員';
                                    $empLabelEn = 'Contract';
                                } else if ($v->employment_type === 'part_time') {
                                    $empBadge = 'badge-secondary';
                                    $empLabelJa = 'パート・アルバイト';
                                    $empLabelEn = 'Part-time';
                                } else if ($v->employment_type === 'internship') {
                                    $empBadge = 'badge-teal';
                                    $empLabelJa = 'インターン';
                                    $empLabelEn = 'Internship';
                                }

                                $salaryStr = '';
                                if ($v->salary_min && $v->salary_max) {
                                    $salaryStr = number_format($v->salary_min) . '円 〜 ' . number_format($v->salary_max) . '円';
                                } else if ($v->salary_min) {
                                    $salaryStr = number_format($v->salary_min) . '円〜';
                                } else if (!empty($v->salary_note_ja)) {
                                    $salaryStr = $v->salary_note_ja;
                                }
                            @endphp
                            <tr>
                                <td class="align-middle">
                                    <span class="badge badge-dark font-mono text-sm px-2 py-1">{{ $v->job_code }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark">{{ $v->title_ja }}</div>
                                    <div class="text-xs text-muted">{{ $v->title_en }}</div>
                                    <div class="text-xs mt-1 text-secondary">
                                        <span class="mr-2"><i class="fas fa-tasks mr-1"></i>{{ $v->responsibilities->count() }} 業務</span>
                                        <span class="mr-2"><i class="fas fa-check mr-1"></i>{{ $v->requirements->count() }} 要件</span>
                                        <span><i class="fas fa-gift mr-1"></i>{{ $v->benefits->count() }} 福利厚生</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="badge {{ $empBadge }}">{{ $isEn ? $empLabelEn : $empLabelJa }}</span>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="text-truncate" style="max-width: 260px;">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $v->location_ja }}
                                    </div>
                                    <div class="text-muted text-xs mt-1">
                                        <i class="fas fa-yen-sign text-success mr-1"></i> {{ $salaryStr ?: ($isEn ? 'Negotiable' : '経験により決定') }}
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <form action="{{ route('admin.vacancies.status', $v->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $v->status === 'published' ? 'draft' : 'published' }}">
                                        <button type="submit" class="badge {{ $statusBadgeClass }} border-0 px-2 py-1" style="cursor: pointer;" title="{{ $isEn ? 'Click to toggle status' : 'クリックしてステータスを切替' }}">
                                            <i class="fas {{ $v->status === 'published' ? 'fa-check-circle' : 'fa-pause-circle' }} mr-1"></i>
                                            {{ $isEn ? $statusLabelEn : $statusLabelJa }}
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-light border">{{ $v->sort_order }}</span>
                                </td>
                                <td class="align-middle text-right text-nowrap">
                                    <a href="/careers/{{ $v->job_code }}" target="_blank" class="btn btn-xs btn-outline-info mr-1" title="{{ $isEn ? 'Preview' : 'プレビュー' }}">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-xs btn-outline-primary mr-1" onclick='openEditVacancyModal(@json($v))' title="{{ $isEn ? 'Edit' : '編集' }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.vacancies.duplicate', $v->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ $isEn ? 'Duplicate this job posting?' : 'この求人情報を複製して下書きを作成しますか？' }}');">
                                        @csrf
                                        <button type="submit" class="btn btn-xs btn-outline-secondary mr-1" title="{{ $isEn ? 'Duplicate' : '複製' }}">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.vacancies.delete', $v->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ $isEn ? 'Permanently delete this job vacancy?' : 'この求人情報を完全に削除しますか？関連する要件・福利厚生も削除されます。' }}');">
                                        @csrf
                                        <button type="submit" class="btn btn-xs btn-outline-danger" title="{{ $isEn ? 'Delete' : '削除' }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- CREATE / EDIT VACANCY MODAL -->
<div class="modal fade" id="modalVacancyForm" tabindex="-1" role="dialog" aria-labelledby="modalVacancyLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form id="vacancyForm" method="POST" action="{{ route('admin.vacancies.store') }}">
                @csrf
                <div class="modal-header bg-primary text-white py-2">
                    <h5 class="modal-title font-weight-bold" id="modalVacancyLabel">
                        <i class="fas fa-user-tie mr-2"></i>{{ $isEn ? 'Job Vacancy Details' : '自社求人情報の登録・編集' }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-3">
                    <!-- Nav Tabs for Bilingual & Organization -->
                    <ul class="nav nav-tabs mb-3" id="vacancyTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" id="tab-basic-link" data-toggle="tab" href="#tab-basic" role="tab">
                                <i class="fas fa-info-circle mr-1"></i> {{ $isEn ? 'Basic Info & Compensation' : '基本情報・給与条件' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="tab-duties-link" data-toggle="tab" href="#tab-duties" role="tab">
                                <i class="fas fa-tasks mr-1"></i> {{ $isEn ? 'Job Duties (Responsibilities)' : '業務内容・担当業務' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="tab-reqs-link" data-toggle="tab" href="#tab-reqs" role="tab">
                                <i class="fas fa-check-circle mr-1"></i> {{ $isEn ? 'Requirements (Skills & JLPT)' : '応募要件・必須/歓迎スキル' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="tab-benefits-link" data-toggle="tab" href="#tab-benefits" role="tab">
                                <i class="fas fa-heart mr-1"></i> {{ $isEn ? 'Benefits & Working Hours' : '福利厚生・勤務条件' }}
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="vacancyTabContent">
                        <!-- TAB 1: BASIC INFO & COMPENSATION -->
                        <div class="tab-pane fade show active" id="tab-basic" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Job Code (e.g. MIR-2026-001)' : '求人コード (例: MIR-2026-001)' }} <span class="text-danger">*</span></label>
                                        <input type="text" name="job_code" id="input_job_code" class="form-control" required placeholder="MIR-2026-001">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Employment Type' : '雇用形態' }} <span class="text-danger">*</span></label>
                                        <select name="employment_type" id="input_employment_type" class="form-control" required>
                                            <option value="full_time">{{ $isEn ? 'Full-time (Regular Employee)' : '正社員（総合職）' }}</option>
                                            <option value="contract">{{ $isEn ? 'Contract Employee' : '契約社員' }}</option>
                                            <option value="part_time">{{ $isEn ? 'Part-time' : 'パート・アルバイト' }}</option>
                                            <option value="internship">{{ $isEn ? 'Internship' : 'インターンシップ' }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Status' : '公開ステータス' }}</label>
                                        <select name="status" id="input_status" class="form-control">
                                            <option value="published">{{ $isEn ? 'Published (Active)' : '公開中 (募集中)' }}</option>
                                            <option value="draft">{{ $isEn ? 'Draft (Private)' : '下書き (非公開)' }}</option>
                                            <option value="closed">{{ $isEn ? 'Closed (Archived)' : '募集終了' }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Sort Order' : '表示順序' }}</label>
                                        <input type="number" name="sort_order" id="input_sort_order" class="form-control" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Job Title (Japanese)' : '求人タイトル・職種名（日本語）' }} <span class="text-danger">*</span></label>
                                        <input type="text" name="title_ja" id="input_title_ja" class="form-control" required placeholder="総合職（海外人材コーディネーター 兼 一般事務・経理補助）">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Job Title (English)' : '求人タイトル・職種名（英語）' }} <span class="text-danger">*</span></label>
                                        <input type="text" name="title_en" id="input_title_en" class="form-control" required placeholder="Global Talent Coordinator, General Affairs & Accounting Assistant">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Location (Japanese)' : '勤務地（日本語）' }} <span class="text-danger">*</span></label>
                                        <input type="text" name="location_ja" id="input_location_ja" class="form-control" required placeholder="東京都小金井市（JR中央線 東小金井駅・武蔵小金井駅）">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Location (English)' : '勤務地（英語）' }} <span class="text-danger">*</span></label>
                                        <input type="text" name="location_en" id="input_location_en" class="form-control" required placeholder="Koganei-shi, Tokyo, Japan (Near JR Higashi-Koganei Station)">
                                    </div>
                                </div>
                            </div>

                            <div class="card card-body bg-light border p-3 mb-3">
                                <h6 class="font-weight-bold text-primary mb-3"><i class="fas fa-coins mr-1"></i> {{ $isEn ? 'Salary & Compensation' : '給与・報酬条件' }}</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label class="text-xs font-weight-bold">{{ $isEn ? 'Salary Type' : '給与形態' }}</label>
                                            <select name="salary_type" id="input_salary_type" class="form-control form-control-sm">
                                                <option value="monthly">{{ $isEn ? 'Monthly Salary' : '月給' }}</option>
                                                <option value="hourly">{{ $isEn ? 'Hourly Wage' : '時給' }}</option>
                                                <option value="annual">{{ $isEn ? 'Annual Salary' : '年俸' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label class="text-xs font-weight-bold">{{ $isEn ? 'Minimum Salary (JPY)' : '給与下限 (円)' }}</label>
                                            <input type="number" name="salary_min" id="input_salary_min" class="form-control form-control-sm" placeholder="220000">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label class="text-xs font-weight-bold">{{ $isEn ? 'Maximum Salary (JPY)' : '給与上限 (円)' }}</label>
                                            <input type="number" name="salary_max" id="input_salary_max" class="form-control form-control-sm" placeholder="250000">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="text-xs font-weight-bold">{{ $isEn ? 'Salary Note (Japanese)' : '給与特記事項（日本語）' }}</label>
                                            <input type="text" name="salary_note_ja" id="input_salary_note_ja" class="form-control form-control-sm" placeholder="月給 220,000円 〜 250,000円（経験・能力を考慮の上決定。賞与年2回）">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="text-xs font-weight-bold">{{ $isEn ? 'Salary Note (English)' : '給与特記事項（英語）' }}</label>
                                            <input type="text" name="salary_note_en" id="input_salary_note_en" class="form-control form-control-sm" placeholder="Monthly: JPY 220,000 – 250,000 (Based on qualifications, bonuses twice/yr)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Overview Description (Japanese)' : '求人概要・募集背景（日本語）' }}</label>
                                        <textarea name="description_ja" id="input_description_ja" class="form-control" rows="4" placeholder="MIRANSH合同会社では、自社の海外人材紹介・特定技能支援事業を支える総合職（正社員）を募集しています..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Overview Description (English)' : '求人概要・募集背景（英語）' }}</label>
                                        <textarea name="description_en" id="input_description_en" class="form-control" rows="4" placeholder="MIRANSH LLC is seeking a dedicated Global Talent Coordinator and Back-Office Assistant for our internal team..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: DUTIES / RESPONSIBILITIES REPEATER -->
                        <div class="tab-pane fade" id="tab-duties" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-bold text-dark mb-0">{{ $isEn ? 'Key Responsibilities & Assigned Duties' : '仕事内容・主な担当業務一覧' }}</h6>
                                    <small class="text-muted">{{ $isEn ? 'Define specific tasks and assignments for this position.' : '求職者が担当する具体的な業務項目を追加してください。' }}</small>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addDutyItem()">
                                    <i class="fas fa-plus mr-1"></i> {{ $isEn ? 'Add Duty Item' : '業務項目を追加' }}
                                </button>
                            </div>

                            <div id="duties_container">
                                <!-- Dynamically added duty items -->
                            </div>
                        </div>

                        <!-- TAB 3: REQUIREMENTS REPEATER -->
                        <div class="tab-pane fade" id="tab-reqs" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-bold text-dark mb-0">{{ $isEn ? 'Requirements (Required vs. Preferred Skills)' : '応募資格・スキル要件（必須 / 歓迎）' }}</h6>
                                    <small class="text-muted">{{ $isEn ? 'Specify required degrees, languages (JLPT), and preferred background.' : '学歴、日本語能力（JLPT）、Excelスキルなどの要件を設定してください。' }}</small>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRequirementItem()">
                                    <i class="fas fa-plus mr-1"></i> {{ $isEn ? 'Add Requirement' : '要件項目を追加' }}
                                </button>
                            </div>

                            <div id="requirements_container">
                                <!-- Dynamically added requirement items -->
                            </div>
                        </div>

                        <!-- TAB 4: BENEFITS & WORKING CONDITIONS -->
                        <div class="tab-pane fade" id="tab-benefits" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Working Hours (Japanese)' : '勤務時間（日本語）' }}</label>
                                        <input type="text" name="working_hours_ja" id="input_working_hours_ja" class="form-control" placeholder="9:00 〜 18:00（実働8時間、休憩60分）">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Working Hours (English)' : '勤務時間（英語）' }}</label>
                                        <input type="text" name="working_hours_en" id="input_working_hours_en" class="form-control" placeholder="9:00 - 18:00 (8 hours work, 60-min break)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Holidays & Vacations (Japanese)' : '休日・休暇（日本語）' }}</label>
                                        <input type="text" name="holidays_ja" id="input_holidays_ja" class="form-control" placeholder="完全週休2日制（土日）、祝日、年末年始、有給休暇">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">{{ $isEn ? 'Holidays & Vacations (English)' : '休日・休暇（英語）' }}</label>
                                        <input type="text" name="holidays_en" id="input_holidays_en" class="form-control" placeholder="5-day work week (Saturdays, Sundays, Public holidays off)">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-bold text-dark mb-0">{{ $isEn ? 'Company Benefits & Welfare Perks' : '福利厚生・待遇・サポート制度' }}</h6>
                                    <small class="text-muted">{{ $isEn ? 'Social insurance, visa extension assistance, PC provision, etc.' : '各種社会保険完備、ビザ更新支援、PC貸与、交通費支給など。' }}</small>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addBenefitItem()">
                                    <i class="fas fa-plus mr-1"></i> {{ $isEn ? 'Add Benefit' : '福利厚生項目を追加' }}
                                </button>
                            </div>

                            <div id="benefits_container">
                                <!-- Dynamically added benefit items -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $isEn ? 'Cancel' : 'キャンセル' }}</button>
                    <button type="submit" class="btn btn-primary font-weight-bold px-4">
                        <i class="fas fa-save mr-1"></i> {{ $isEn ? 'Save Job Vacancy' : '求人情報を保存' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let dutyCount = 0;
let reqCount = 0;
let benefitCount = 0;

function openCreateVacancyModal() {
    $('#modalVacancyLabel').html('<i class="fas fa-plus-circle mr-2"></i>{{ $isEn ? "Add New Job Vacancy" : "新規自社求人の登録" }}');
    $('#vacancyForm').attr('action', '{{ route("admin.vacancies.store") }}');
    
    // Clear inputs
    $('#input_job_code').val('MIR-' + new Date().getFullYear() + '-' + String(Math.floor(Math.random() * 900) + 100));
    $('#input_title_ja').val('');
    $('#input_title_en').val('');
    $('#input_employment_type').val('full_time');
    $('#input_location_ja').val('東京都小金井市（JR中央線 東小金井駅・武蔵小金井駅）');
    $('#input_location_en').val('Koganei-shi, Tokyo, Japan');
    $('#input_salary_min').val('220000');
    $('#input_salary_max').val('250000');
    $('#input_salary_type').val('monthly');
    $('#input_salary_note_ja').val('月給 220,000円 〜 250,000円（経験・能力を考慮の上決定。賞与年2回）');
    $('#input_salary_note_en').val('Monthly Salary: JPY 220,000 – 250,000 (Based on experience & qualifications)');
    $('#input_working_hours_ja').val('9:00 〜 18:00（実働8時間、休憩60分）');
    $('#input_working_hours_en').val('9:00 - 18:00 (8 hours work, 60-min break)');
    $('#input_holidays_ja').val('完全週休2日制（土日）、祝日、年末年始休暇、年次有給休暇');
    $('#input_holidays_en').val('5-day work week (Saturdays, Sundays off), Public holidays, Annual paid leave');
    $('#input_description_ja').val('');
    $('#input_description_en').val('');
    $('#input_status').val('published');
    $('#input_sort_order').val('0');

    // Reset repeaters
    $('#duties_container').empty();
    $('#requirements_container').empty();
    $('#benefits_container').empty();
    dutyCount = 0;
    reqCount = 0;
    benefitCount = 0;

    // Seed default items for quick creation
    addDutyItem('海外人材の募集・マッチング管理', 'Recruitment & Candidate Sourcing', '求職者情報のデータベース登録・管理、ヒアリング、選考日程調整', 'Candidate database management, interviews, and company matching');
    addDutyItem('通訳・翻訳および書類作成', 'Translation & Documentation', '日英・ネパール語での通訳・翻訳、在留資格申請書類・履歴書作成補助', 'Translation support, visa application paperwork, resume checking');
    addDutyItem('経理・営業事務補助', 'Accounting & Admin Support', '請求書発行、経費精算、電話・メール応対などのバックオフィス業務', 'Invoicing, expense reporting, phone/email reception');

    addRequirementItem('required', '専門学校（経営経済・ビジネス情報系課程）修了者、または同等以上の学歴', 'Vocational college graduate (Business Administration, Economics, or Information Systems) or equivalent');
    addRequirementItem('required', '日本語能力試験 N3 以上（円滑なビジネスコミュニケーション）', 'Japanese Language Proficiency Test (JLPT) N3 or higher');
    addRequirementItem('preferred', '日本語能力試験 N2 以上、または BJT 400点以上', 'JLPT N2 or higher, or BJT 400 points or above');

    addBenefitItem('各種社会保険完備', 'Full Social Insurance Coverage', '健康保険、厚生年金保険、雇用保険、労災保険', 'Health insurance, employees pension, employment insurance, industrial accident compensation');
    addBenefitItem('在留資格更新・変更サポート', 'Visa Extension Support', '就労ビザ（技術・人文知識・国際業務など）の更新手続きを全面的に会社が支援', 'Full company administrative assistance for work visa extensions');

    $('#modalVacancyForm').modal('show');
}

function openEditVacancyModal(v) {
    $('#modalVacancyLabel').html('<i class="fas fa-edit mr-2"></i>{{ $isEn ? "Edit Job Vacancy" : "求人情報の編集" }}: ' + v.job_code);
    $('#vacancyForm').attr('action', '/admin/vacancies/' + v.id);

    $('#input_job_code').val(v.job_code);
    $('#input_title_ja').val(v.title_ja);
    $('#input_title_en').val(v.title_en);
    $('#input_employment_type').val(v.employment_type || 'full_time');
    $('#input_location_ja').val(v.location_ja);
    $('#input_location_en').val(v.location_en);
    $('#input_salary_min').val(v.salary_min);
    $('#input_salary_max').val(v.salary_max);
    $('#input_salary_type').val(v.salary_type || 'monthly');
    $('#input_salary_note_ja').val(v.salary_note_ja);
    $('#input_salary_note_en').val(v.salary_note_en);
    $('#input_working_hours_ja').val(v.working_hours_ja);
    $('#input_working_hours_en').val(v.working_hours_en);
    $('#input_holidays_ja').val(v.holidays_ja);
    $('#input_holidays_en').val(v.holidays_en);
    $('#input_description_ja').val(v.description_ja);
    $('#input_description_en').val(v.description_en);
    $('#input_status').val(v.status || 'published');
    $('#input_sort_order').val(v.sort_order || 0);

    // Reset repeaters
    $('#duties_container').empty();
    $('#requirements_container').empty();
    $('#benefits_container').empty();
    dutyCount = 0;
    reqCount = 0;
    benefitCount = 0;

    if (v.responsibilities && v.responsibilities.length > 0) {
        v.responsibilities.forEach(r => {
            addDutyItem(r.title_ja, r.title_en, r.description_ja, r.description_en);
        });
    }

    if (v.requirements && v.requirements.length > 0) {
        v.requirements.forEach(r => {
            addRequirementItem(r.type, r.description_ja, r.description_en);
        });
    }

    if (v.benefits && v.benefits.length > 0) {
        v.benefits.forEach(b => {
            addBenefitItem(b.title_ja, b.title_en, b.description_ja, b.description_en);
        });
    }

    $('#modalVacancyForm').modal('show');
}

function addDutyItem(titleJa = '', titleEn = '', descJa = '', descEn = '') {
    const idx = dutyCount++;
    const html = `
        <div class="card card-body bg-light border p-2 mb-2 duty-row" id="duty_row_${idx}">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="badge badge-primary font-weight-bold">業務 #${idx + 1}</span>
                <button type="button" class="btn btn-xs btn-outline-danger" onclick="$('#duty_row_${idx}').remove()">
                    <i class="fas fa-times mr-1"></i> 削除
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-1">
                    <input type="text" name="responsibilities[${idx}][title_ja]" class="form-control form-control-sm" placeholder="業務タイトル（日本語）" value="${titleJa.replace(/"/g, '&quot;')}">
                </div>
                <div class="col-md-6 mb-1">
                    <input type="text" name="responsibilities[${idx}][title_en]" class="form-control form-control-sm" placeholder="Title (English)" value="${titleEn.replace(/"/g, '&quot;')}">
                </div>
                <div class="col-md-6">
                    <textarea name="responsibilities[${idx}][description_ja]" class="form-control form-control-sm" rows="2" placeholder="詳細説明（日本語）">${descJa}</textarea>
                </div>
                <div class="col-md-6">
                    <textarea name="responsibilities[${idx}][description_en]" class="form-control form-control-sm" rows="2" placeholder="Description (English)">${descEn}</textarea>
                </div>
            </div>
        </div>
    `;
    $('#duties_container').append(html);
}

function addRequirementItem(type = 'required', descJa = '', descEn = '') {
    const idx = reqCount++;
    const html = `
        <div class="card card-body bg-light border p-2 mb-2 req-row" id="req_row_${idx}">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div class="d-flex align-items-center">
                    <span class="badge badge-secondary font-weight-bold mr-2">要件 #${idx + 1}</span>
                    <select name="requirements[${idx}][type]" class="form-control form-control-sm" style="width: 140px;">
                        <option value="required" ${type === 'required' ? 'selected' : ''}>必須要件 (Required)</option>
                        <option value="preferred" ${type === 'preferred' ? 'selected' : ''}>歓迎要件 (Preferred)</option>
                    </select>
                </div>
                <button type="button" class="btn btn-xs btn-outline-danger" onclick="$('#req_row_${idx}').remove()">
                    <i class="fas fa-times mr-1"></i> 削除
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-1">
                    <input type="text" name="requirements[${idx}][description_ja]" class="form-control form-control-sm" placeholder="応募要件の内容（日本語）" value="${descJa.replace(/"/g, '&quot;')}">
                </div>
                <div class="col-md-6 mb-1">
                    <input type="text" name="requirements[${idx}][description_en]" class="form-control form-control-sm" placeholder="Requirement content (English)" value="${descEn.replace(/"/g, '&quot;')}">
                </div>
            </div>
        </div>
    `;
    $('#requirements_container').append(html);
}

function addBenefitItem(titleJa = '', titleEn = '', descJa = '', descEn = '') {
    const idx = benefitCount++;
    const html = `
        <div class="card card-body bg-light border p-2 mb-2 benefit-row" id="benefit_row_${idx}">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="badge badge-success font-weight-bold">福利厚生 #${idx + 1}</span>
                <button type="button" class="btn btn-xs btn-outline-danger" onclick="$('#benefit_row_${idx}').remove()">
                    <i class="fas fa-times mr-1"></i> 削除
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-1">
                    <input type="text" name="benefits[${idx}][title_ja]" class="form-control form-control-sm" placeholder="項目名（例: 各種社会保険完備）" value="${titleJa.replace(/"/g, '&quot;')}">
                </div>
                <div class="col-md-6 mb-1">
                    <input type="text" name="benefits[${idx}][title_en]" class="form-control form-control-sm" placeholder="Benefit Title (English)" value="${titleEn.replace(/"/g, '&quot;')}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="benefits[${idx}][description_ja]" class="form-control form-control-sm" placeholder="説明（例: 健康保険、厚生年金、雇用保険、労災保険）" value="${descJa.replace(/"/g, '&quot;')}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="benefits[${idx}][description_en]" class="form-control form-control-sm" placeholder="Description (English)" value="${descEn.replace(/"/g, '&quot;')}">
                </div>
            </div>
        </div>
    `;
    $('#benefits_container').append(html);
}
</script>
@endpush
