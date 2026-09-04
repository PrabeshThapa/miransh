@extends('layouts.adminlte')

@section('title', 'ダッシュボード概要')
@section('page_title', 'ダッシュボード概要')

@section('breadcrumb')
    <li class="breadcrumb-item active">概要</li>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $inquiries->count() }}</h3>
                <p>総お問い合わせ数</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <a href="{{ route('admin.inquiries') }}" class="small-box-footer">一覧を確認 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $services->count() }}</h3>
                <p>提供サービス項目</p>
            </div>
            <div class="icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <a href="{{ route('admin.services') }}" class="small-box-footer">サービス管理 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stories->count() }}</h3>
                <p>採用事例・ストーリー</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="{{ route('admin.stories') }}" class="small-box-footer">事例管理 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $faqs->count() }}</h3>
                <p>よくある質問 (FAQ)</p>
            </div>
            <div class="icon">
                <i class="fas fa-question-circle"></i>
            </div>
            <a href="{{ route('admin.faqs') }}" class="small-box-footer">FAQ管理 <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left column: Recent Inquiries -->
    <div class="col-lg-8">
        <div class="card card-outline card-primary">
            <div class="card-header border-transparent">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-inbox text-primary mr-1"></i> 最新のお問い合わせ
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.inquiries') }}" class="btn btn-sm btn-tool text-primary font-weight-bold">
                        すべて見る <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>受信日時</th>
                                <th>送信者 / 企業名</th>
                                <th>ご関心分野</th>
                                <th>ステータス</th>
                                <th class="text-right">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inquiries->take(5) as $inq)
                                <tr>
                                    <td class="text-nowrap text-sm text-muted">
                                        {{ \Illuminate\Support\Carbon::parse($inq->created_at)->format('Y/m/d H:i') }}
                                    </td>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $inq->name }}</div>
                                        <div class="text-xs text-muted">{{ $inq->company_name ?: '個人' }} ({{ $inq->email }})</div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light border text-xs">{{ $inq->service_interest ?: '一般相談' }}</span>
                                    </td>
                                    <td>
                                        @if($inq->status === 'unread')
                                            <span class="badge badge-danger">未対応</span>
                                        @elseif($inq->status === 'in_progress')
                                            <span class="badge badge-warning text-dark">対応中</span>
                                        @else
                                            <span class="badge badge-success">完了</span>
                                        @endif
                                    </td>
                                    <td class="text-right text-nowrap">
                                        <button type="button" class="btn btn-xs btn-info btn-view-inquiry" 
                                                data-name="{{ $inq->name }}"
                                                data-company="{{ $inq->company_name }}"
                                                data-email="{{ $inq->email }}"
                                                data-phone="{{ $inq->phone }}"
                                                data-service="{{ $inq->service_interest }}"
                                                data-message="{{ $inq->message }}"
                                                data-date="{{ \Illuminate\Support\Carbon::parse($inq->created_at)->format('Y/m/d H:i') }}"
                                                data-id="{{ $inq->id }}">
                                            <i class="fas fa-eye"></i> 詳細
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        現在、届いているお問い合わせはありません。
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix bg-white">
                <a href="{{ route('admin.inquiries') }}" class="btn btn-sm btn-outline-primary float-right">
                    お問い合わせ管理を開く
                </a>
            </div>
        </div>

        <!-- Latest Case Studies -->
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-newspaper text-secondary mr-1"></i> 公開中の採用事例・ストーリー
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.stories') }}" class="btn btn-sm btn-tool text-primary">
                        事例管理へ <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @forelse($stories->take(4) as $story)
                        <li class="item d-flex align-items-center py-2 px-3">
                            <div class="product-img mr-3">
                                <img src="{{ $story->image ?: '/images/story1.jpg' }}" alt="Story Image" class="img-size-50 rounded" style="object-fit: cover; width: 50px; height: 50px;">
                            </div>
                            <div class="product-info flex-grow-1">
                                <a href="{{ route('admin.stories') }}" class="product-title font-weight-bold text-dark text-sm">
                                    {{ $story->title_ja }}
                                    @if($story->featured)
                                        <span class="badge badge-warning float-right text-xs">注目事例</span>
                                    @endif
                                </a>
                                <span class="product-description text-xs text-muted text-truncate" style="max-width: 500px;">
                                    {{ $story->summary_ja }}
                                </span>
                            </div>
                        </li>
                    @empty
                        <li class="item text-center py-3 text-muted">登録済みの事例はありません。</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Right column: Company Summary & Quick Links -->
    <div class="col-lg-4">
        <!-- Company Profile Info Card -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile text-center">
                <div class="text-center mb-3">
                    <img class="profile-user-img img-fluid img-circle elevation-2"
                         src="{{ $company->ceo_image ?: '/images/ceo_portrait.jpg' }}"
                         alt="CEO Portrait"
                         style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <h3 class="profile-username font-weight-bold mb-1">{{ $company->name_ja }}</h3>
                <p class="text-muted text-sm mb-3">{{ $company->ceo_name_ja }}（{{ $company->ceo_role_ja }}）</p>

                <ul class="list-group list-group-unbordered mb-3 text-left text-sm">
                    <li class="list-group-item d-flex justify-content-between">
                        <b>法人番号</b> <span class="text-muted">{{ $company->corporate_number }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <b>紹介事業許可</b> <span class="text-muted">{{ $company->license }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <b>代表電話</b> <span class="text-muted">{{ $company->phone }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <b>代表メール</b> <span class="text-muted">{{ $company->email }}</span>
                    </li>
                </ul>

                <a href="{{ route('admin.company') }}" class="btn btn-primary btn-block font-weight-bold">
                    <i class="fas fa-edit mr-1"></i> 会社情報・写真を編集
                </a>
            </div>
        </div>

        <!-- Quick Access Navigation -->
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title font-weight-bold text-sm">
                    <i class="fas fa-bolt text-warning mr-1"></i> クイックアクセス
                </h3>
            </div>
            <div class="card-body p-2">
                <a href="{{ route('admin.company') }}" class="btn btn-outline-secondary btn-block text-left mb-2 py-2">
                    <i class="fas fa-building text-primary mr-2"></i> 会社情報・ロゴ・写真変更
                </a>
                <a href="{{ route('admin.about') }}" class="btn btn-outline-secondary btn-block text-left mb-2 py-2">
                    <i class="fas fa-handshake text-success mr-2"></i> 企業理念・CEOメッセージ
                </a>
                <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary btn-block text-left mb-2 py-2">
                    <i class="fas fa-briefcase text-info mr-2"></i> 提供サービス内容の編集
                </a>
                <a href="{{ route('admin.password') }}" class="btn btn-outline-secondary btn-block text-left mb-2 py-2">
                    <i class="fas fa-key text-danger mr-2"></i> 管理者パスワードの変更
                </a>
                <a href="{{ route('admin.ai') }}" class="btn btn-outline-secondary btn-block text-left py-2">
                    <i class="fas fa-robot text-purple mr-2"></i> Sakana AI 接続・設定確認
                </a>
            </div>
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
                        <div class="font-weight-bold text-dark" id="modal-inq-name">-</div>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-xs text-muted mb-0">法人名 / 団体名</label>
                        <div class="font-weight-bold text-dark" id="modal-inq-company">-</div>
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
                    <label class="text-xs text-muted mb-0">ご関心分野</label>
                    <div class="badge badge-info p-2" id="modal-inq-service">-</div>
                </div>
                <div class="mb-3">
                    <label class="text-xs text-muted mb-1">お問い合わせ内容</label>
                    <div class="p-3 bg-light rounded border text-dark" style="white-space: pre-wrap; font-size: 0.95rem; line-height: 1.6;" id="modal-inq-message">-</div>
                </div>
            </div>
            <div class="modal-footer bg-light d-flex justify-content-between">
                <a href="#" id="modal-inq-reply-btn" class="btn btn-primary" target="_blank">
                    <i class="fas fa-reply mr-1"></i> メールで返信する
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
        var company = $(this).data('company') || '個人';
        var email = $(this).data('email');
        var phone = $(this).data('phone') || '-';
        var service = $(this).data('service') || '一般相談';
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
