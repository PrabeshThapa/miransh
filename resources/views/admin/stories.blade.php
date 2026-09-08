@php
    $currLang = strtolower(request()->query('lang', request()->cookie('admin_lang', session('admin_lang', 'ja'))));
    if (!in_array($currLang, ['ja', 'en'])) $currLang = 'ja';
    $isEn = ($currLang === 'en');
@endphp

@extends('layouts.adminlte')

@section('title', $isEn ? 'Case Studies & Stories Management' : '採用事例・実績管理')
@section('page_title', $isEn ? 'Case Studies & Stories Management' : '採用事例・実績管理 (Case Studies & Stories)')

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ $isEn ? 'Case Studies Management' : '採用事例管理' }}</li>
@endsection

@section('content')
<div class="card card-outline card-primary shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-newspaper text-primary mr-2"></i>{{ $isEn ? 'Stories & Case Studies List' : '事例・ストーリー一覧' }}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-success font-weight-bold shadow-xs" data-toggle="modal" data-target="#modal-create-story">
                <i class="fas fa-plus mr-1"></i> {{ $isEn ? '+ Create New Story' : '新規事例を登録' }}
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 90px;">{{ $isEn ? 'Thumbnail' : '画像' }}</th>
                        <th>{{ $isEn ? 'Story Title (JA / EN)' : 'タイトル (日 / 英)' }}</th>
                        <th>{{ $isEn ? 'Category' : 'カテゴリ' }}</th>
                        <th class="text-center">{{ $isEn ? 'Featured' : '注目' }}</th>
                        <th>{{ $isEn ? 'Published Date' : '公開日' }}</th>
                        <th style="width: 140px;" class="text-right">{{ $isEn ? 'Actions' : '操作' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stories as $story)
                        <tr>
                            <td class="align-middle text-muted text-sm font-weight-bold">{{ $story->id }}</td>
                            <td class="align-middle">
                                <img src="{{ $story->image ?: '/images/story1.jpg' }}" alt="Story Image" class="rounded elevation-1" style="width: 65px; height: 45px; object-fit: cover;">
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">{{ $story->title_ja }}</div>
                                <div class="text-xs text-muted">{{ $story->title_en }}</div>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-info text-xs">{{ $isEn && !empty($story->category_en) ? $story->category_en : $story->category_ja }}</span>
                            </td>
                            <td class="align-middle text-center">
                                @if($story->featured)
                                    <span class="badge badge-warning text-xs font-weight-bold">Featured</span>
                                @else
                                    <span class="badge badge-light text-muted text-xs">-</span>
                                @endif
                            </td>
                            <td class="align-middle text-muted text-sm">{{ $story->published_date }}</td>
                            <td class="align-middle text-right text-nowrap">
                                <button type="button" class="btn btn-sm btn-primary btn-edit-story shadow-xs"
                                        data-id="{{ $story->id }}"
                                        data-title-ja="{{ $story->title_ja }}"
                                        data-title-en="{{ $story->title_en }}"
                                        data-category-ja="{{ $story->category_ja }}"
                                        data-category-en="{{ $story->category_en }}"
                                        data-summary-ja="{{ $story->summary_ja }}"
                                        data-summary-en="{{ $story->summary_en }}"
                                        data-image="{{ $story->image }}"
                                        data-date="{{ $story->published_date }}"
                                        data-featured="{{ $story->featured ? '1' : '0' }}"
                                        data-sort="{{ $story->sort_order }}"
                                        title="{{ $isEn ? 'Edit Story' : '編集' }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="/admin/stories/{{ $story->id }}/delete" method="POST" class="d-inline" onsubmit="return confirm('{{ $isEn ? 'Are you sure you want to delete this case study?' : '本当にこの事例を削除しますか？' }}');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger shadow-xs" title="{{ $isEn ? 'Delete Story' : '削除' }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                {{ $isEn ? 'No case studies or stories registered yet.' : '登録されている事例はありません。' }}
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
<!-- Create Story Modal -->
<div class="modal fade" id="modal-create-story" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="/admin/stories" enctype="multipart/form-data">
            @csrf
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-plus-circle mr-2"></i>{{ $isEn ? 'Create Case Study / Story' : '新規事例・ストーリーの作成' }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Story Title (Japanese)' : 'タイトル (日本語)' }} <span class="text-danger">*</span></label>
                            <input type="text" name="title_ja" class="form-control" placeholder="{{ $isEn ? 'e.g. 東京都内介護施設様への特定技能人材採用' : '例: 東京都内介護施設様への特定技能人材採用' }}" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Story Title (English)' : 'Title (English)' }} <span class="text-danger">*</span></label>
                            <input type="text" name="title_en" class="form-control" placeholder="{{ $isEn ? 'e.g. Placement of Caregiving SSW in Tokyo Facility' : '例: Placement of Caregiving SSW in Tokyo Facility' }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Category (Japanese)' : 'カテゴリ (日本語)' }}</label>
                            <input type="text" name="category_ja" class="form-control" value="介護分野・特定技能">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Category (English)' : 'Category (English)' }}</label>
                            <input type="text" name="category_en" class="form-control" value="Nursing Care SSW">
                        </div>
                    </div>

                    <!-- Image Upload & Preview Card -->
                    <div class="card card-outline card-info bg-light border p-3 mb-3">
                        <label class="text-sm font-weight-bold text-dark mb-2">
                            <i class="fas fa-image text-primary mr-1"></i> {{ $isEn ? 'Story Image (Upload or Specify URL)' : '事例画像 (アップロードまたはURL)' }}
                        </label>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-2 mb-md-0">
                                <div class="border rounded bg-white p-1 d-inline-block shadow-xs">
                                    <img id="create-story-img-preview" src="/images/story1.jpg" alt="Story Preview" class="rounded" style="width: 130px; height: 85px; object-fit: cover;">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-xs btn-outline-secondary mt-1" onclick="resetStoryImage('create', '/images/story1.jpg')">
                                        <i class="fas fa-undo mr-1"></i>{{ $isEn ? 'Default Image' : '初期画像' }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="upload-dropzone p-3 text-center border-dashed rounded bg-white shadow-xs" style="border: 2px dashed #0d6efd;" ondragover="event.preventDefault();" ondrop="handleStoryDrop(event, 'create')">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-1"></i>
                                    <div class="text-xs text-muted mb-2">
                                        {{ $isEn ? 'Drag & drop image file here, or browse from device' : '画像をここにドラッグ＆ドロップ、または端末から選択' }}
                                    </div>
                                    <label class="btn btn-xs btn-primary font-weight-bold mb-0 shadow-xs">
                                        <i class="fas fa-folder-open mr-1"></i> {{ $isEn ? 'Select & Upload Image' : '画像ファイルを選択' }}
                                        <input type="file" name="story_image_file" class="d-none" accept="image/*" onchange="uploadStoryImageFile(this, 'create')">
                                    </label>
                                    <div id="create_story_upload_status" class="text-xs font-weight-bold mt-1"></div>
                                </div>
                                <div class="input-group input-group-sm mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-xs bg-white">{{ $isEn ? 'URL / Path' : 'URL / パス' }}</span>
                                    </div>
                                    <input type="text" name="image" id="create-story-image" class="form-control" value="/images/story1.jpg" oninput="syncStoryImagePreview(this.value, 'create')">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Publication Date' : '公開日' }}</label>
                            <input type="text" name="published_date" class="form-control" value="{{ date('Y.m.d') }}">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Featured Setting' : '注目設定' }}</label>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" name="featured" class="custom-control-input" id="check-create-featured" value="1">
                                <label class="custom-control-label font-weight-bold text-dark" for="check-create-featured">
                                    {{ $isEn ? 'Feature on Homepage' : 'Featured表示' }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Summary (Japanese)' : '概要・サマリー (日本語)' }} <span class="text-danger">*</span></label>
                            <textarea name="summary_ja" class="form-control" rows="3" required placeholder="{{ $isEn ? 'Brief summary of the placement story...' : '導入事例の概要・ハイライトを記入...' }}"></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Summary (English)' : 'Summary (English)' }} <span class="text-danger">*</span></label>
                            <textarea name="summary_en" class="form-control" rows="3" required placeholder="{{ $isEn ? 'Brief summary of the placement story in English...' : 'Write English summary here...' }}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">
                        {{ $isEn ? 'Cancel' : 'キャンセル' }}
                    </button>
                    <button type="submit" class="btn btn-success font-weight-bold shadow-xs">
                        <i class="fas fa-check mr-1"></i>{{ $isEn ? 'Create Story' : '登録する' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Story Modal -->
<div class="modal fade" id="modal-edit-story" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit-story" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>{{ $isEn ? 'Edit Case Study / Story' : '事例・ストーリーの編集' }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Story Title (Japanese)' : 'タイトル (日本語)' }} <span class="text-danger">*</span></label>
                            <input type="text" name="title_ja" id="edit-story-title-ja" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Story Title (English)' : 'Title (English)' }} <span class="text-danger">*</span></label>
                            <input type="text" name="title_en" id="edit-story-title-en" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Category (Japanese)' : 'カテゴリ (日本語)' }}</label>
                            <input type="text" name="category_ja" id="edit-story-cat-ja" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Category (English)' : 'Category (English)' }}</label>
                            <input type="text" name="category_en" id="edit-story-cat-en" class="form-control">
                        </div>
                    </div>

                    <!-- Image Upload & Preview Card for Edit Modal -->
                    <div class="card card-outline card-info bg-light border p-3 mb-3">
                        <label class="text-sm font-weight-bold text-dark mb-2">
                            <i class="fas fa-image text-primary mr-1"></i> {{ $isEn ? 'Story Image (Upload or Specify URL)' : '事例画像 (アップロードまたはURL)' }}
                        </label>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-2 mb-md-0">
                                <div class="border rounded bg-white p-1 d-inline-block shadow-xs">
                                    <img id="edit-story-img-preview" src="/images/story1.jpg" alt="Story Preview" class="rounded" style="width: 130px; height: 85px; object-fit: cover;">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-xs btn-outline-secondary mt-1" onclick="resetStoryImage('edit', '/images/story1.jpg')">
                                        <i class="fas fa-undo mr-1"></i>{{ $isEn ? 'Default Image' : '初期画像' }}
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="upload-dropzone p-3 text-center border-dashed rounded bg-white shadow-xs" style="border: 2px dashed #0d6efd;" ondragover="event.preventDefault();" ondrop="handleStoryDrop(event, 'edit')">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-1"></i>
                                    <div class="text-xs text-muted mb-2">
                                        {{ $isEn ? 'Drag & drop image file here, or browse from device' : '画像をここにドラッグ＆ドロップ、または端末から選択' }}
                                    </div>
                                    <label class="btn btn-xs btn-primary font-weight-bold mb-0 shadow-xs">
                                        <i class="fas fa-folder-open mr-1"></i> {{ $isEn ? 'Select & Upload Image' : '画像ファイルを選択' }}
                                        <input type="file" name="story_image_file" class="d-none" accept="image/*" onchange="uploadStoryImageFile(this, 'edit')">
                                    </label>
                                    <div id="edit_story_upload_status" class="text-xs font-weight-bold mt-1"></div>
                                </div>
                                <div class="input-group input-group-sm mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-xs bg-white">{{ $isEn ? 'URL / Path' : '画像URL / パス' }}</span>
                                    </div>
                                    <input type="text" name="image" id="edit-story-image" class="form-control" oninput="syncStoryImagePreview(this.value, 'edit')">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Publication Date' : '公開日' }}</label>
                            <input type="text" name="published_date" id="edit-story-date" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Featured Setting' : '注目設定' }}</label>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" name="featured" class="custom-control-input" id="edit-story-featured" value="1">
                                <label class="custom-control-label font-weight-bold text-dark" for="edit-story-featured">
                                    {{ $isEn ? 'Feature on Homepage' : 'Featured表示' }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Summary (Japanese)' : '概要・サマリー (日本語)' }} <span class="text-danger">*</span></label>
                            <textarea name="summary_ja" id="edit-story-summary-ja" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">{{ $isEn ? 'Summary (English)' : 'Summary (English)' }} <span class="text-danger">*</span></label>
                            <textarea name="summary_en" id="edit-story-summary-en" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">
                        {{ $isEn ? 'Cancel' : 'キャンセル' }}
                    </button>
                    <button type="submit" class="btn btn-primary font-weight-bold shadow-xs">
                        <i class="fas fa-save mr-1"></i>{{ $isEn ? 'Save Changes' : '保存する' }}
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
    $('.btn-edit-story').on('click', function() {
        var id = $(this).data('id');
        $('#form-edit-story').attr('action', '/admin/stories/' + id);
        $('#edit-story-title-ja').val($(this).data('title-ja'));
        $('#edit-story-title-en').val($(this).data('title-en'));
        $('#edit-story-cat-ja').val($(this).data('category-ja'));
        $('#edit-story-cat-en').val($(this).data('category-en'));
        
        var imgUrl = $(this).data('image') || '/images/story1.jpg';
        $('#edit-story-image').val(imgUrl);
        $('#edit-story-img-preview').attr('src', imgUrl);
        $('#edit_story_upload_status').empty();

        $('#edit-story-date').val($(this).data('date'));
        $('#edit-story-featured').prop('checked', $(this).data('featured') == '1');
        $('#edit-story-summary-ja').val($(this).data('summary-ja'));
        $('#edit-story-summary-en').val($(this).data('summary-en'));
        $('#modal-edit-story').modal('show');
    });
});

function syncStoryImagePreview(val, mode) {
    var preview = document.getElementById(mode + '-story-img-preview');
    if (preview && val) {
        preview.src = val;
    }
}

function resetStoryImage(mode, defaultUrl) {
    var input = document.getElementById(mode + '-story-image');
    var preview = document.getElementById(mode + '-story-img-preview');
    var status = document.getElementById(mode + '_story_upload_status');
    if (input) input.value = defaultUrl;
    if (preview) preview.src = defaultUrl;
    if (status) status.innerHTML = '';
}

function uploadStoryImageFile(inputEl, mode) {
    if (!inputEl.files || !inputEl.files[0]) return;
    var file = inputEl.files[0];
    processStoryUpload(file, mode);
}

function handleStoryDrop(event, mode) {
    event.preventDefault();
    if (event.dataTransfer && event.dataTransfer.files && event.dataTransfer.files[0]) {
        processStoryUpload(event.dataTransfer.files[0], mode);
    }
}

function processStoryUpload(file, mode) {
    var isEn = {{ $isEn ? 'true' : 'false' }};
    var preview = document.getElementById(mode + '-story-img-preview');
    var input = document.getElementById(mode + '-story-image');
    var status = document.getElementById(mode + '_story_upload_status');

    // Instant local preview via FileReader
    var reader = new FileReader();
    reader.onload = function(e) {
        if (preview) preview.src = e.target.result;
    };
    reader.readAsDataURL(file);

    if (status) {
        status.innerHTML = '<span class="text-primary"><i class="fas fa-spinner fa-spin mr-1"></i>' + (isEn ? 'Uploading image...' : '画像をアップロード中...') + '</span>';
    }

    var fd = new FormData();
    fd.append('file', file);
    fd.append('image', file);
    fd.append('type', 'story');

    fetch('/api/admin/upload-image', {
        method: 'POST',
        body: fd
    })
    .then(function(res) {
        if (!res.ok) throw new Error('Upload failed: ' + res.status);
        return res.json();
    })
    .then(function(data) {
        var url = data.url || data.path || (data.file && data.file.path);
        if (url) {
            if (input) input.value = url;
            if (preview) preview.src = url;
            if (status) {
                status.innerHTML = '<span class="text-success"><i class="fas fa-check-circle mr-1"></i>' + (isEn ? 'Upload successful!' : 'アップロード完了！') + '</span>';
            }
        } else {
            throw new Error('No URL returned');
        }
    })
    .catch(function(err) {
        // Fallback: if AJAX endpoint isn't reached, inform user that form submission will process the file
        if (status) {
            status.innerHTML = '<span class="text-info"><i class="fas fa-info-circle mr-1"></i>' + (isEn ? 'Ready for save (' + file.name + ')' : '保存時に登録されます (' + file.name + ')') + '</span>';
        }
    });
}
</script>
@endpush
