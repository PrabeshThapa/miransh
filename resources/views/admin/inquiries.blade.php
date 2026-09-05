@extends('layouts.adminlte')

@section('title', 'お問い合わせ管理')
@section('page_title', 'お問い合わせ管理 (Inquiries Inbox)')

@section('breadcrumb')
    <li class="breadcrumb-item active">お問い合わせ管理</li>
@endsection

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-inbox text-primary mr-2"></i>受信お問い合わせ一覧
        </h3>
        <div class="card-tools">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <a href="{{ route('admin.inquiries') }}" class="btn btn-sm btn-outline-secondary {{ empty(request('status')) ? 'active' : '' }}">
                    すべて ({{ $inquiries->count() }})
                </a>
                <a href="{{ route('admin.inquiries', ['status' => 'unread']) }}" class="btn btn-sm btn-outline-danger {{ request('status') === 'unread' ? 'active' : '' }}">
                    未対応 ({{ $inquiries->where('status', 'unread')->count() }})
                </a>
                <a href="{{ route('admin.inquiries', ['status' => 'resolved']) }}" class="btn btn-sm btn-outline-success {{ request('status') === 'resolved' ? 'active' : '' }}">
                    完了済 ({{ $inquiries->where('status', 'resolved')->count() }})
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
                        <th style="width: 140px;">受信日時</th>
                        <th>送信者・企業名</th>
                        <th>連絡先</th>
                        <th>ご関心分野</th>
                        <th>メッセージ概要</th>
                        <th style="width: 110px;">ステータス</th>
                        <th style="width: 150px;" class="text-right">操作</th>
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
                                <div class="text-xs text-muted">{{ $inq->company_name ?: '（法人指定なし）' }}</div>
                            </td>
                            <td class="align-middle text-sm">
                                <div><a href="mailto:{{ $inq->email }}" class="text-primary">{{ $inq->email }}</a></div>
                                <div class="text-xs text-muted">{{ $inq->phone ?: '-' }}</div>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-light border text-xs">{{ $inq->service_interest ?: '一般' }}</span>
                            </td>
                            <td class="align-middle text-sm text-muted" style="max-width: 250px;">
                                <div class="text-truncate">{{ $inq->message }}</div>
                            </td>
                            <td class="align-middle">
                                <form action="/admin/inquiries/{{ $inq->id }}/status" method="POST" class="d-inline">
                                    @csrf
                                    <select name="status" class="form-control form-control-sm text-xs font-weight-bold" onchange="this.form.submit()">
                                        <option value="unread" {{ $inq->status === 'unread' ? 'selected' : '' }}>未対応</option>
                                        <option value="in_progress" {{ $inq->status === 'in_progress' ? 'selected' : '' }}>対応中</option>
                                        <option value="resolved" {{ $inq->status === 'resolved' ? 'selected' : '' }}>対応完了</option>
                                    </select>
                                </form>
                            </td>
                            <td class="align-middle text-right text-nowrap">
                                <button type="button" class="btn btn-sm btn-info btn-view-inquiry"
                                        data-name="{{ $inq->name }}"
                                        data-company="{{ $inq->company_name }}"
                                        data-email="{{ $inq->email }}"
                                        data-phone="{{ $inq->phone }}"
                                        data-service="{{ $inq->service_interest }}"
                                        data-message="{{ $inq->message }}"
                                        data-date="{{ \Illuminate\Support\Carbon::parse($inq->created_at)->format('Y/m/d H:i') }}">
                                    <i class="fas fa-eye"></i> 詳細
                                </button>
                                <form action="/admin/inquiries/{{ $inq->id }}/delete" method="POST" class="d-inline" onsubmit="return confirm('このお問い合わせを削除しますか？');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                お問い合わせはありません。
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
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-envelope-open-text mr-2"></i>お問い合わせ詳細
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">送信者氏名</label>
                        <div class="font-weight-bold text-dark h5" id="modal-inq-name">-</div>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">法人名 / 団体名</label>
                        <div class="font-weight-bold text-dark h5" id="modal-inq-company">-</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">メールアドレス</label>
                        <div><a href="#" id="modal-inq-email-link" class="text-primary font-weight-bold">-</a></div>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">電話番号</label>
                        <div id="modal-inq-phone">-</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="text-xs text-muted mb-0">関心のあるサービス・分野</label>
                    <div class="badge badge-info p-2 font-weight-bold" id="modal-inq-service">-</div>
                </div>
                <div class="mb-3">
                    <label class="text-xs text-muted mb-1">お問い合わせ本文</label>
                    <div class="p-3 bg-light rounded border text-dark" style="white-space: pre-wrap; font-size: 1rem; line-height: 1.6;" id="modal-inq-message">-</div>
                </div>
            </div>
            <div class="modal-footer bg-light d-flex justify-content-between">
                <a href="#" id="modal-inq-reply-btn" class="btn btn-primary font-weight-bold" target="_blank">
                    <i class="fas fa-reply mr-1"></i> メーラーを起動して返信する
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('.btn-view-inquiry').on('click', function() {
        var name = $(this).data('name');
        var company = $(this).data('company') || '（指定なし）';
        var email = $(this).data('email');
        var phone = $(this).data('phone') || '-';
        var service = $(this).data('service') || '一般';
        var message = $(this).data('message');

        $('#modal-inq-name').text(name);
        $('#modal-inq-company').text(company);
        $('#modal-inq-email-link').text(email).attr('href', 'mailto:' + email);
        $('#modal-inq-phone').text(phone);
        $('#modal-inq-service').text(service);
        $('#modal-inq-message').text(message);
        $('#modal-inq-reply-btn').attr('href', 'mailto:' + email + '?subject=' + encodeURIComponent('【MIRANSH合同会社】お問い合わせへのご返信'));

        $('#modal-view-inquiry').modal('show');
    });
});
</script>
@endpush
