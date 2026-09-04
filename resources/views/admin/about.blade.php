@extends('layouts.adminlte')

@section('title', '企業理念・メッセージ')
@section('page_title', '企業理念・メッセージ設定')

@section('breadcrumb')
    <li class="breadcrumb-item active">企業理念・メッセージ</li>
@endsection

@section('content')
<form action="{{ route('admin.about.update') }}" method="POST">
    @csrf
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-handshake text-primary mr-2"></i>理念・ミッション・CEOメッセージ (About & Philosophy)
            </h3>
            <div class="card-tools">
                <button type="submit" class="btn btn-sm btn-primary font-weight-bold">
                    <i class="fas fa-save mr-1"></i> 変更を保存
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">バッジテキスト (日本語)</label>
                    <input type="text" name="badge_ja" class="form-control" value="{{ old('badge_ja', $about->badge_ja) }}">
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">Badge Text (English)</label>
                    <input type="text" name="badge_en" class="form-control" value="{{ old('badge_en', $about->badge_en) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">メイン見出し (日本語)</label>
                    <input type="text" name="heading_ja" class="form-control" value="{{ old('heading_ja', $about->heading_ja) }}">
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">Main Heading (English)</label>
                    <input type="text" name="heading_en" class="form-control" value="{{ old('heading_en', $about->heading_en) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">サブ見出し (日本語)</label>
                    <textarea name="subheading_ja" class="form-control" rows="2">{{ old('subheading_ja', $about->subheading_ja) }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">Subheading (English)</label>
                    <textarea name="subheading_en" class="form-control" rows="2">{{ old('subheading_en', $about->subheading_en) }}</textarea>
                </div>
            </div>

            <hr class="my-4">
            <h5 class="font-weight-bold text-dark mb-3">
                <i class="fas fa-comment-dots text-info mr-2"></i>企業詳細・創業への思い (Philosophy Descriptions)
            </h5>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">段落1 (日本語)</label>
                    <textarea name="desc1_ja" class="form-control" rows="4">{{ old('desc1_ja', $about->desc1_ja) }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">Paragraph 1 (English)</label>
                    <textarea name="desc1_en" class="form-control" rows="4">{{ old('desc1_en', $about->desc1_en) }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">段落2 (日本語)</label>
                    <textarea name="desc2_ja" class="form-control" rows="4">{{ old('desc2_ja', $about->desc2_ja) }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">Paragraph 2 (English)</label>
                    <textarea name="desc2_en" class="form-control" rows="4">{{ old('desc2_en', $about->desc2_en) }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">引用・スローガン (日本語)</label>
                    <textarea name="quote_ja" class="form-control" rows="3">{{ old('quote_ja', $about->quote_ja) }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label class="text-sm font-weight-bold">Quote / Slogan (English)</label>
                    <textarea name="quote_en" class="form-control" rows="3">{{ old('quote_en', $about->quote_en) }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-right">
            <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                <i class="fas fa-save mr-1"></i> 企業理念・メッセージを保存
            </button>
        </div>
    </div>
</form>
@endsection
