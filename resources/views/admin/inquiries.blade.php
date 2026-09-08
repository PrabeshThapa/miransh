@php
    $currLang = strtolower(request()->query('lang', request()->cookie('admin_lang', session('admin_lang', 'ja'))));
    if (!in_array($currLang, ['ja', 'en'])) $currLang = 'ja';
    $isEn = ($currLang === 'en');
@endphp

@extends('layouts.adminlte')

@section('title', $isEn ? 'Inquiries Inbox' : 'お問い合わせ管理')
@section('page_title', $isEn ? 'Inquiries Inbox' : 'お問い合わせ管理 (Inquiries Inbox)')

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ $isEn ? 'Inquiries' : 'お問い合わせ管理' }}</li>
@endsection

@section('content')
<div class="card card-outline card-primary shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-inbox text-primary mr-2"></i>{{ $isEn ? 'Received Customer & Corporate Inquiries' : '受信お問い合わせ一覧' }}
        </h3>
        <div class="card-tools">
            <div class="btn-group btn-group-toggle shadow-xs" data-toggle="buttons">
                <a href="{{ route('admin.inquiries') }}" class="btn btn-sm btn-outline-secondary {{ empty(request('status')) ? 'active font-weight-bold' : '' }}">
                    {{ $isEn ? 'All' : 'すべて' }} ({{ $inquiries->count() }})
                </a>
                <a href="{{ route('admin.inquiries', ['status' => 'unread']) }}" class="btn btn-sm btn-outline-danger {{ request('status') === 'unread' ? 'active font-weight-bold' : '' }}">
                    {{ $isEn ? 'Pending' : '未対応' }} ({{ $inquiries->where('status', 'unread')->count() }})
                </a>
                <a href="{{ route('admin.inquiries', ['status' => 'resolved']) }}" class="btn btn-sm btn-outline-success {{ request('status') === 'resolved' ? 'active font-weight-bold' : '' }}">
                    {{ $isEn ? 'Resolved' : '完了済' }} ({{ $inquiries->where('status', 'resolved')->count() }})
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 140px;">{{ $isEn ? 'Received Date' : '受信日時' }}</th>
                        <th>{{ $isEn ? 'Sender / Company' : '送信者・企業名' }}</th>
                        <th>{{ $isEn ? 'Contact Info' : '連絡先' }}</th>
                        <th>{{ $isEn ? 'Area of Interest' : 'ご関心分野' }}</th>
                        <th>{{ $isEn ? 'Message Summary' : 'メッセージ概要' }}</th>
                        <th style="width: 130px;">{{ $isEn ? 'Status' : 'ステータス' }}</th>
                        <th style="width: 150px;" class="text-right">{{ $isEn ? 'Actions' : '操作' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $filtered = $inquiries;
                        if (request('status') === 'unread') {
                            $filtered = $inquiries->where('status', 'unread');
                        } elseif (request('status') === 'resolved') {
                            $filtered = $inquiries->where('status', 'resolved');
                        }
                    @endphp

                    @forelse($filtered as $inq)
                        <tr>
                            <td class="align-middle text-muted text-sm font-weight-bold">{{ $inq->id }}</td>
                            <td class="align-middle text-sm text-muted text-nowrap">
                                {{ \Illuminate\Support\Carbon::parse($inq->created_at)->format('Y/m/d H:i') }}
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">{{ $inq->name }}</div>
                                <div class="text-xs text-muted">{{ $inq->company_name ?: ($isEn ? '(Individual / Not specified)' : '（法人指定なし）') }}</div>
                            </td>
                            <td class="align-middle text-sm">
                                <div><a href="mailto:{{ $inq->email }}" class="text-primary">{{ $inq->email }}</a></div>
                                <div class="text-xs text-muted">{{ $inq->phone ?: '-' }}</div>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-light border text-xs">{{ $inq->service_interest ?: ($isEn ? 'General' : '一般') }}</span>
                            </td>
                            <td class="align-middle text-sm text-muted" style="max-width: 250px;">
                                <div class="text-truncate">{{ $inq->message }}</div>
                            </td>
                            <td class="align-middle">
                                <form action="/admin/inquiries/{{ $inq->id }}/status" method="POST" class="d-inline">
                                    @csrf
                                    <select name="status" class="form-control form-control-sm text-xs font-weight-bold" onchange="this.form.submit()">
                                        <option value="unread" {{ $inq->status === 'unread' ? 'selected' : '' }}>{{ $isEn ? 'Pending / Unread' : '未対応' }}</option>
                                        <option value="in_progress" {{ $inq->status === 'in_progress' ? 'selected' : '' }}>{{ $isEn ? 'In Progress' : '対応中' }}</option>
                                        <option value="resolved" {{ $inq->status === 'resolved' ? 'selected' : '' }}>{{ $isEn ? 'Resolved' : '対応完了' }}</option>
                                    </select>
                                </form>
                            </td>
                            <td class="align-middle text-right text-nowrap">
                                <button type="button" class="btn btn-sm btn-info btn-view-inquiry shadow-xs"
                                        data-name="{{ $inq->name }}"
                                        data-company="{{ $inq->company_name }}"
                                        data-email="{{ $inq->email }}"
                                        data-phone="{{ $inq->phone }}"
                                        data-service="{{ $inq->service_interest }}"
                                        data-message="{{ $inq->message }}"
                                        data-date="{{ \Illuminate\Support\Carbon::parse($inq->created_at)->format('Y/m/d H:i') }}"
                                        title="{{ $isEn ? 'View Details' : '詳細' }}">
                                    <i class="fas fa-eye"></i> {{ $isEn ? 'Details' : '詳細' }}
                                </button>
                                <form action="/admin/inquiries/{{ $inq->id }}/delete" method="POST" class="d-inline" onsubmit="return confirm('{{ $isEn ? 'Are you sure you want to delete this inquiry message?' : 'このお問い合わせを削除しますか？' }}');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-xs" title="{{ $isEn ? 'Delete' : '削除' }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                {{ $isEn ? 'No inquiries found matching your filter.' : 'お問い合わせはありません。' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('modals')
<!-- Inquiry Detail Modal -->
<div class="modal fade" id="modal-view-inquiry" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-envelope-open-text mr-2"></i>{{ $isEn ? 'Inquiry Message Details' : 'お問い合わせ詳細' }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">{{ $isEn ? 'Sender Name' : '送信者氏名' }}</label>
                        <div class="font-weight-bold text-dark h5" id="modal-inq-name">-</div>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">{{ $isEn ? 'Company / Organization' : '法人名 / 団体名' }}</label>
                        <div class="font-weight-bold text-dark h5" id="modal-inq-company">-</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">{{ $isEn ? 'Email Address' : 'メールアドレス' }}</label>
                        <div><a href="#" id="modal-inq-email-link" class="text-primary font-weight-bold">-</a></div>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">{{ $isEn ? 'Phone Number' : '電話番号' }}</label>
                        <div id="modal-inq-phone">-</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="text-xs text-muted mb-0">{{ $isEn ? 'Service Area of Interest' : '関心のあるサービス・分野' }}</label>
                    <div class="badge badge-info p-2 font-weight-bold" id="modal-inq-service">-</div>
                </div>
                <div class="mb-3">
                    <label class="text-xs text-muted mb-1">{{ $isEn ? 'Message Body' : 'お問い合わせ本文' }}</label>
                    <div class="p-3 bg-light rounded border text-dark" style="white-space: pre-wrap; font-size: 1rem; line-height: 1.6;" id="modal-inq-message">-</div>
                </div>
            </div>
            <div class="modal-footer bg-light d-flex justify-content-between">
                <a href="#" id="modal-inq-reply-btn" class="btn btn-primary font-weight-bold shadow-xs" target="_blank">
                    <i class="fas fa-reply mr-1"></i> {{ $isEn ? 'Open Mail Client to Reply' : 'メーラーを起動して返信する' }}
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $isEn ? 'Close' : '閉じる' }}</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('.btn-view-inquiry').on('click', function() {
        var isEn = {{ $isEn ? 'true' : 'false' }};
        var name = $(this).data('name');
        var company = $(this).data('company') || (isEn ? '(Not specified)' : '（指定なし）');
        var email = $(this).data('email');
        var phone = $(this).data('phone') || '-';
        var service = $(this).data('service') || (isEn ? 'General' : '一般');
        var message = $(this).data('message');

        $('#modal-inq-name').text(name);
        $('#modal-inq-company').text(company);
        $('#modal-inq-email-link').text(email).attr('href', 'mailto:' + email);
        $('#modal-inq-phone').text(phone);
        $('#modal-inq-service').text(service);
        $('#modal-inq-message').text(message);
        var replySubject = isEn ? '[MIRANSH LLC] Regarding Your Inquiry' : '【MIRANSH合同会社】お問い合わせへのご返信';
        $('#modal-inq-reply-btn').attr('href', 'mailto:' + email + '?subject=' + encodeURIComponent(replySubject));

        $('#modal-view-inquiry').modal('show');
    });
});
</script>
@endpush
