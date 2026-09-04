@extends('layouts.adminlte')

@section('title', '提供サービス管理')
@section('page_title', '提供サービス管理 (Services)')

@section('breadcrumb')
    <li class="breadcrumb-item active">提供サービス管理</li>
@endsection

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-briefcase text-primary mr-2"></i>主要事業・サービス一覧 (Registered Core Services)
        </h3>
        <div class="card-tools">
            <span class="badge badge-info mr-2">全 {{ $services->count() }} 件</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 70px;">番号</th>
                        <th style="width: 90px;">イメージ</th>
                        <th>サービス名 (日 / 英)</th>
                        <th>概要</th>
                        <th style="width: 80px;" class="text-center">表示順</th>
                        <th style="width: 140px;" class="text-right">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $svc)
                        <tr>
                            <td class="font-weight-bold text-primary align-middle">
                                #{{ $svc->number_label }}
                            </td>
                            <td class="align-middle">
                                <img src="{{ $svc->image }}" alt="{{ $svc->title_ja }}" class="rounded elevation-1" style="width: 65px; height: 45px; object-fit: cover;">
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">{{ $svc->title_ja }}</div>
                                <div class="text-xs text-muted">{{ $svc->title_en }}</div>
                            </td>
                            <td class="align-middle text-sm text-muted" style="max-width: 320px;">
                                <div class="text-truncate">{{ $svc->desc_ja }}</div>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-secondary">{{ $svc->sort_order }}</span>
                            </td>
                            <td class="align-middle text-right text-nowrap">
                                <button type="button" class="btn btn-sm btn-primary btn-edit-service"
                                        data-id="{{ $svc->id }}"
                                        data-number="{{ $svc->number_label }}"
                                        data-title-ja="{{ $svc->title_ja }}"
                                        data-title-en="{{ $svc->title_en }}"
                                        data-desc-ja="{{ $svc->desc_ja }}"
                                        data-desc-en="{{ $svc->desc_en }}"
                                        data-image="{{ $svc->image }}"
                                        data-sort="{{ $svc->sort_order }}"
                                        data-items-ja="{{ is_array($svc->items_ja) ? implode("\n", $svc->items_ja) : $svc->items_ja }}"
                                        data-items-en="{{ is_array($svc->items_en) ? implode("\n", $svc->items_en) : $svc->items_en }}">
                                    <i class="fas fa-edit mr-1"></i> 編集
                                </button>
                                <a href="/services/{{ $svc->id }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="詳細ページを確認">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('modals')
<!-- Edit Service Modal -->
<div class="modal fade" id="modal-edit-service" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit-service" method="POST" action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>サービス情報の編集
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">サービス番号</label>
                            <input type="text" name="number_label" id="edit-svc-number" class="form-control" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">表示優先度 (Sort)</label>
                            <input type="number" name="sort_order" id="edit-svc-sort" class="form-control" value="0">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">画像URL</label>
                            <input type="text" name="image" id="edit-svc-image" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">サービス名称 (日本語)</label>
                            <input type="text" name="title_ja" id="edit-svc-title-ja" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Service Title (English)</label>
                            <input type="text" name="title_en" id="edit-svc-title-en" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">サービス概要 (日本語)</label>
                            <textarea name="desc_ja" id="edit-svc-desc-ja" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Service Description (English)</label>
                            <textarea name="desc_en" id="edit-svc-desc-en" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">主要特徴・提供内容 (日本語 / 1行1項目)</label>
                            <textarea name="items_ja" id="edit-svc-items-ja" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Key Offerings / Features (English / 1 item per line)</label>
                            <textarea name="items_en" id="edit-svc-items-en" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-save mr-1"></i> 変更を更新
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('.btn-edit-service').on('click', function() {
        var id = $(this).data('id');
        $('#form-edit-service').attr('action', '/admin/services/' + id);
        $('#edit-svc-number').val($(this).data('number'));
        $('#edit-svc-sort').val($(this).data('sort'));
        $('#edit-svc-image').val($(this).data('image'));
        $('#edit-svc-title-ja').val($(this).data('title-ja'));
        $('#edit-svc-title-en').val($(this).data('title-en'));
        $('#edit-svc-desc-ja').val($(this).data('desc-ja'));
        $('#edit-svc-desc-en').val($(this).data('desc-en'));
        $('#edit-svc-items-ja').val($(this).data('items-ja'));
        $('#edit-svc-items-en').val($(this).data('items-en'));
        $('#modal-edit-service').modal('show');
    });
});
</script>
@endpush
