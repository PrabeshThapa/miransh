@php
    $currLang = strtolower(request()->query('lang', request()->cookie('admin_lang', session('admin_lang', 'ja'))));
    if (!in_array($currLang, ['ja', 'en'])) $currLang = 'ja';
    $isEn = ($currLang === 'en');
@endphp

@extends('layouts.adminlte')

@section('title', $isEn ? 'Services Management' : '提供サービス管理')
@section('page_title', $isEn ? 'Services & Offerings Management' : '提供サービス管理 (Services)')

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ $isEn ? 'Services Management' : '提供サービス管理' }}</li>
@endsection

@section('content')
<div class="card card-outline card-primary shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-briefcase text-primary mr-2"></i>{{ $isEn ? 'Core Business Services' : '主要事業・サービス一覧 (Registered Core Services)' }}
        </h3>
        <div class="card-tools">
            <span class="badge badge-info mr-2">{{ $isEn ? 'Total: ' . $services->count() . ' services' : '全 ' . $services->count() . ' 件' }}</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 70px;">{{ $isEn ? 'No.' : '番号' }}</th>
                        <th style="width: 90px;">{{ $isEn ? 'Thumbnail' : 'イメージ' }}</th>
                        <th>{{ $isEn ? 'Service Title (JA / EN)' : 'サービス名 (日 / 英)' }}</th>
                        <th>{{ $isEn ? 'Summary' : '概要' }}</th>
                        <th style="width: 80px;" class="text-center">{{ $isEn ? 'Order' : '表示順' }}</th>
                        <th style="width: 140px;" class="text-right">{{ $isEn ? 'Actions' : '操作' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $svc)
                        <tr>
                            <td class="font-weight-bold text-primary align-middle">
                                #{{ $svc->number_label }}
                            </td>
                            <td class="align-middle">
                                <img src="{{ $svc->image ?: '/images/service1.jpg' }}" alt="{{ $svc->title_ja }}" class="rounded elevation-1" style="width: 65px; height: 45px; object-fit: cover;">
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">{{ $svc->title_ja }}</div>
                                <div class="text-xs text-muted">{{ $svc->title_en }}</div>
                            </td>
                            <td class="align-middle text-sm text-muted" style="max-width: 320px;">
                                <div class="text-truncate">{{ $isEn && !empty($svc->desc_en) ? $svc->desc_en : $svc->desc_ja }}</div>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-secondary">{{ $svc->sort_order }}</span>
                            </td>
                            <td class="align-middle text-right text-nowrap">
                                <button type="button" class="btn btn-sm btn-primary btn-edit-service shadow-xs"
                                        data-id="{{ $svc->id }}"
                                        data-number="{{ $svc->number_label }}"
                                        data-title-ja="{{ $svc->title_ja }}"
                                        data-title-en="{{ $svc->title_en }}"
                                        data-desc-ja="{{ $svc->desc_ja }}"
                                        data-desc-en="{{ $svc->desc_en }}"
                                        data-image="{{ $svc->image }}"
                                        data-sort="{{ $svc->sort_order }}"
                                        data-items-ja="{{ is_array($svc->items_ja) ? implode("\n", $svc->items_ja) : $svc->items_ja }}"
                                        data-items-en="{{ is_array($svc->items_en) ? implode("\n", $svc->items_en) : $svc->items_en }}"
                                        title="{{ $isEn ? 'Edit Service' : '編集' }}">
                                    <i class="fas fa-edit mr-1"></i> {{ $isEn ? 'Edit' : '編集' }}
                                </button>
                                <a href="/services/{{ $svc->id }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="{{ $isEn ? 'View Public Page' : '詳細ページを確認' }}">
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
        <form id="form-edit-service" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>{{ $isEn ? 'Edit Service Details' : 'サービス情報の編集' }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Service Number' : 'サービス番号' }}</label>
                            <input type="text" name="number_label" id="edit-svc-number" class="form-control" required>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Display Priority' : '表示優先度 (Sort)' }}</label>
                            <input type="number" name="sort_order" id="edit-svc-sort" class="form-control" value="0">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Service Title (Japanese)' : 'サービス名称 (日本語)' }} <span class="text-danger">*</span></label>
                            <input type="text" name="title_ja" id="edit-svc-title-ja" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Service Title (English)' : 'Service Title (English)' }} <span class="text-danger">*</span></label>
                            <input type="text" name="title_en" id="edit-svc-title-en" class="form-control" required>
                        </div>
                    </div>

                    <!-- Service Image Upload & Preview Card -->
                    <div class="card card-outline card-info bg-light border p-3 mb-3">
                        <label class="text-sm font-weight-bold text-dark mb-2">
                            <i class="fas fa-image text-primary mr-1"></i> {{ $isEn ? 'Service Cover Image (Upload or URL)' : 'サービス画像 (アップロードまたはURL)' }}
                        </label>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-2 mb-md-0">
                                <div class="border rounded bg-white p-1 d-inline-block shadow-xs">
                                    <img id="edit-svc-img-preview" src="/images/service1.jpg" alt="Service Preview" class="rounded" style="width: 130px; height: 85px; object-fit: cover;">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-xs btn-outline-secondary mt-1" onclick="resetSvcImage('/images/service1.jpg')">
                                        <i class="fas fa-undo mr-1"></i>{{ $isEn ? 'Default Image' : '初期画像' }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="upload-dropzone p-3 text-center border-dashed rounded bg-white shadow-xs" style="border: 2px dashed #0d6efd;">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-1"></i>
                                    <div class="text-xs text-muted mb-2">
                                        {{ $isEn ? 'Select or drop image file from device' : '端末から画像を選択またはドラッグ＆ドロップ' }}
                                    </div>
                                    <label class="btn btn-xs btn-primary font-weight-bold mb-0 shadow-xs">
                                        <i class="fas fa-folder-open mr-1"></i> {{ $isEn ? 'Select & Upload Image' : '画像ファイルを選択' }}
                                        <input type="file" name="service_image_file" class="d-none" accept="image/*" onchange="uploadSvcImageFile(this)">
                                    </label>
                                    <div id="edit_svc_upload_status" class="text-xs font-weight-bold mt-1"></div>
                                </div>
                                <div class="input-group input-group-sm mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-xs bg-white">{{ $isEn ? 'URL / Path' : '画像URL / パス' }}</span>
                                    </div>
                                    <input type="text" name="image" id="edit-svc-image" class="form-control" oninput="syncSvcImagePreview(this.value)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Service Description (Japanese)' : 'サービス概要 (日本語)' }} <span class="text-danger">*</span></label>
                            <textarea name="desc_ja" id="edit-svc-desc-ja" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Service Description (English)' : 'Service Description (English)' }} <span class="text-danger">*</span></label>
                            <textarea name="desc_en" id="edit-svc-desc-en" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Key Inclusions / Features (Japanese / 1 per line)' : '主要特徴・提供内容 (日本語 / 1行1項目)' }}</label>
                            <textarea name="items_ja" id="edit-svc-items-ja" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Key Inclusions / Features (English / 1 per line)' : 'Key Offerings / Features (English / 1 item per line)' }}</label>
                            <textarea name="items_en" id="edit-svc-items-en" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">
                        {{ $isEn ? 'Cancel' : 'キャンセル' }}
                    </button>
                    <button type="submit" class="btn btn-primary font-weight-bold shadow-xs">
                        <i class="fas fa-save mr-1"></i> {{ $isEn ? 'Save Changes' : '変更を更新' }}
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
        var img = $(this).data('image') || '/images/service1.jpg';
        $('#edit-svc-image').val(img);
        $('#edit-svc-img-preview').attr('src', img);
        $('#edit_svc_upload_status').empty();
        $('#edit-svc-title-ja').val($(this).data('title-ja'));
        $('#edit-svc-title-en').val($(this).data('title-en'));
        $('#edit-svc-desc-ja').val($(this).data('desc-ja'));
        $('#edit-svc-desc-en').val($(this).data('desc-en'));
        $('#edit-svc-items-ja').val($(this).data('items-ja'));
        $('#edit-svc-items-en').val($(this).data('items-en'));
        $('#modal-edit-service').modal('show');
    });
});

function syncSvcImagePreview(val) {
    if (val) $('#edit-svc-img-preview').attr('src', val);
}

function resetSvcImage(defaultUrl) {
    $('#edit-svc-image').val(defaultUrl);
    $('#edit-svc-img-preview').attr('src', defaultUrl);
    $('#edit_svc_upload_status').empty();
}

function uploadSvcImageFile(inputEl) {
    if (!inputEl.files || !inputEl.files[0]) return;
    var file = inputEl.files[0];
    var isEn = {{ $isEn ? 'true' : 'false' }};
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#edit-svc-img-preview').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);

    $('#edit_svc_upload_status').html('<span class="text-primary"><i class="fas fa-spinner fa-spin mr-1"></i>' + (isEn ? 'Uploading...' : 'アップロード中...') + '</span>');

    var fd = new FormData();
    fd.append('file', file);
    fd.append('image', file);
    fd.append('type', 'service');

    fetch('/api/admin/upload-image', {
        method: 'POST',
        body: fd
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        var url = data.url || data.path;
        if (url) {
            $('#edit-svc-image').val(url);
            $('#edit-svc-img-preview').attr('src', url);
            $('#edit_svc_upload_status').html('<span class="text-success"><i class="fas fa-check-circle mr-1"></i>' + (isEn ? 'Uploaded successfully!' : 'アップロード完了！') + '</span>');
        }
    })
    .catch(function() {
        $('#edit_svc_upload_status').html('<span class="text-info"><i class="fas fa-info-circle mr-1"></i>' + (isEn ? 'Will be saved with form (' + file.name + ')' : '保存時に登録されます (' + file.name + ')') + '</span>');
    });
}
</script>
@endpush
