@extends('layouts.adminlte')

@section('title', '会社情報・画像設定')
@section('page_title', '会社情報・画像設定')

@section('breadcrumb')
    <li class="breadcrumb-item active">会社情報・画像設定</li>
@endsection

@section('content')
<form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <!-- Basic Corporate Info Card -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-building text-primary mr-2"></i>基本法人情報 (Corporate Registration)
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">会社名 (日本語)</label>
                            <input type="text" name="name_ja" class="form-control" value="{{ old('name_ja', $company->name_ja) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">Company Name (English)</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $company->name_en) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">法人番号 (13桁)</label>
                            <input type="text" name="corporate_number" class="form-control" value="{{ old('corporate_number', $company->corporate_number) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">有料職業紹介事業許可番号</label>
                            <input type="text" name="license" class="form-control" value="{{ old('license', $company->license) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">法人格 (日本語)</label>
                            <input type="text" name="corporate_form_ja" class="form-control" value="{{ old('corporate_form_ja', $company->corporate_form_ja) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">Corporate Form (English)</label>
                            <input type="text" name="corporate_form_en" class="form-control" value="{{ old('corporate_form_en', $company->corporate_form_en) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">設立日 (日本語)</label>
                            <input type="text" name="established_ja" class="form-control" value="{{ old('established_ja', $company->established_ja) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">Established Date (English)</label>
                            <input type="text" name="established_en" class="form-control" value="{{ old('established_en', $company->established_en) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">電話番号</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">代表メールアドレス</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">所在地 (日本語)</label>
                            <textarea name="address_ja" class="form-control" rows="2">{{ old('address_ja', $company->address_ja) }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">Address (English)</label>
                            <textarea name="address_en" class="form-control" rows="2">{{ old('address_en', $company->address_en) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CEO / Representative Info Card -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-tie text-info mr-2"></i>代表者情報 (CEO / Representative)
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">代表者氏名 (日本語)</label>
                            <input type="text" name="ceo_name_ja" class="form-control" value="{{ old('ceo_name_ja', $company->ceo_name_ja) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">CEO Name (English)</label>
                            <input type="text" name="ceo_name_en" class="form-control" value="{{ old('ceo_name_en', $company->ceo_name_en) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">役職名 (日本語)</label>
                            <input type="text" name="ceo_role_ja" class="form-control" value="{{ old('ceo_role_ja', $company->ceo_role_ja) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">Role Title (English)</label>
                            <input type="text" name="ceo_role_en" class="form-control" value="{{ old('ceo_role_en', $company->ceo_role_en) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Banner Content Card -->
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-images text-secondary mr-2"></i>トップページ・ヒーロー領域キャッチコピー
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">ヒーロー見出し (日本語)</label>
                            <input type="text" name="hero_title_ja" class="form-control" value="{{ old('hero_title_ja', $company->hero_title_ja) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">強調部分 (日本語)</label>
                            <input type="text" name="hero_title_accent_ja" class="form-control" value="{{ old('hero_title_accent_ja', $company->hero_title_accent_ja) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm font-weight-bold">ヒーロー説明文 (日本語)</label>
                        <textarea name="hero_desc_ja" class="form-control" rows="3">{{ old('hero_desc_ja', $company->hero_desc_ja) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">Hero Title (English)</label>
                            <input type="text" name="hero_title_en" class="form-control" value="{{ old('hero_title_en', $company->hero_title_en) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-sm font-weight-bold">Accent Part (English)</label>
                            <input type="text" name="hero_title_accent_en" class="form-control" value="{{ old('hero_title_accent_en', $company->hero_title_accent_en) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm font-weight-bold">Hero Description (English)</label>
                        <textarea name="hero_desc_en" class="form-control" rows="3">{{ old('hero_desc_en', $company->hero_desc_en) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar / Media Upload Column -->
        <div class="col-lg-4">
            <!-- CEO Portrait Upload Card -->
            <div class="card card-outline card-success mb-3">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold text-sm">
                        <i class="fas fa-camera text-success mr-2"></i>代表者肖像写真 (CEO Portrait)
                    </h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img id="ceo-img-preview" src="{{ $company->ceo_image ?: '/images/ceo_portrait.jpg' }}" alt="CEO Portrait" class="preview-img rounded-circle elevation-2" style="width: 140px; height: 140px; object-fit: cover;">
                    </div>
                    <div class="form-group mb-2">
                        <label class="text-xs text-muted">画像URL / パス</label>
                        <input type="text" name="ceo_image" id="ceo_image_input" class="form-control form-control-sm text-center" value="{{ old('ceo_image', $company->ceo_image) }}">
                    </div>
                    <div class="custom-file mt-2">
                        <input type="file" name="ceo_image_file" class="custom-file-input" id="ceo_image_file" accept="image/*">
                        <label class="custom-file-label text-left text-xs" for="ceo_image_file">PCから画像を選択...</label>
                    </div>
                    <small class="text-muted d-block mt-2">推奨: 正方形 (400x400px以上) JPEG/PNG/WebP</small>
                </div>
            </div>

            <!-- Hero Banner Upload Card -->
            <div class="card card-outline card-info mb-3">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold text-sm">
                        <i class="fas fa-panorama text-info mr-2"></i>トップ背景バナー (Hero Banner)
                    </h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img id="hero-img-preview" src="{{ $company->hero_image ?: '/images/hero_banner.jpg' }}" alt="Hero Banner" class="preview-img w-100" style="height: 120px; object-fit: cover;">
                    </div>
                    <div class="form-group mb-2">
                        <label class="text-xs text-muted">画像URL / パス</label>
                        <input type="text" name="hero_image" id="hero_image_input" class="form-control form-control-sm text-center" value="{{ old('hero_image', $company->hero_image) }}">
                    </div>
                    <div class="custom-file mt-2">
                        <input type="file" name="hero_image_file" class="custom-file-input" id="hero_image_file" accept="image/*">
                        <label class="custom-file-label text-left text-xs" for="hero_image_file">PCから画像を選択...</label>
                    </div>
                    <small class="text-muted d-block mt-2">推奨: 1920x1080px 横長画像</small>
                </div>
            </div>

            <!-- Save Action Button Card -->
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-block btn-lg font-weight-bold shadow-sm">
                        <i class="fas fa-save mr-2"></i> 設定内容を保存・更新
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-default btn-block mt-2">
                        キャンセル
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    // Live preview for CEO image
    $('#ceo_image_file').on('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            $(this).next('.custom-file-label').html(file.name);
            var reader = new FileReader();
            reader.onload = function(evt) {
                $('#ceo-img-preview').attr('src', evt.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Live preview for Hero banner
    $('#hero_image_file').on('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            $(this).next('.custom-file-label').html(file.name);
            var reader = new FileReader();
            reader.onload = function(evt) {
                $('#hero-img-preview').attr('src', evt.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endpush
