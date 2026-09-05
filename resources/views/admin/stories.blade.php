@extends('layouts.adminlte')

@section('title', '採用事例・実績管理')
@section('page_title', '採用事例・実績管理 (Case Studies & Stories)')

@section('breadcrumb')
    <li class="breadcrumb-item active">採用事例管理</li>
@endsection

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-newspaper text-primary mr-2"></i>事例・ストーリー一覧
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-success font-weight-bold" data-toggle="modal" data-target="#modal-create-story">
                <i class="fas fa-plus mr-1"></i> 新規事例を登録
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 90px;">画像</th>
                        <th>タイトル (日 / 英)</th>
                        <th>カテゴリ</th>
                        <th class="text-center">注目</th>
                        <th>公開日</th>
                        <th style="width: 140px;" class="text-right">操作</th>
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
                                <span class="badge badge-info text-xs">{{ $story->category_ja }}</span>
                            </td>
                            <td class="align-middle text-center">
                                @if($story->featured)
                                    <span class="badge badge-warning text-xs">Featured</span>
                                @else
                                    <span class="badge badge-light text-muted text-xs">-</span>
                                @endif
                            </td>
                            <td class="align-middle text-muted text-sm">{{ $story->published_date }}</td>
                            <td class="align-middle text-right text-nowrap">
                                <button type="button" class="btn btn-sm btn-primary btn-edit-story"
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
                                        data-sort="{{ $story->sort_order }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="/admin/stories/{{ $story->id }}/delete" method="POST" class="d-inline" onsubmit="return confirm('本当にこの事例を削除しますか？');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                登録されている事例はありません。
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
        <form method="POST" action="/admin/stories">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-plus-circle mr-2"></i>新規事例・ストーリーの作成
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">タイトル (日本語)</label>
                            <input type="text" name="title_ja" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Title (English)</label>
                            <input type="text" name="title_en" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">カテゴリ (日本語)</label>
                            <input type="text" name="category_ja" class="form-control" value="介護分野・特定技能">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Category (English)</label>
                            <input type="text" name="category_en" class="form-control" value="Nursing Care SSW">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">画像URL / パス</label>
                            <input type="text" name="image" class="form-control" value="/images/story1.jpg">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">公開日</label>
                            <input type="text" name="published_date" class="form-control" value="{{ date('Y.m.d') }}">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">注目設定</label>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" name="featured" class="custom-control-input" id="check-create-featured" value="1">
                                <label class="custom-control-label" for="check-create-featured">Featured表示</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">概要・サマリー (日本語)</label>
                            <textarea name="summary_ja" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Summary (English)</label>
                            <textarea name="summary_en" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-success font-weight-bold">登録する</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Story Modal -->
<div class="modal fade" id="modal-edit-story" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit-story" method="POST" action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>事例・ストーリーの編集
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">タイトル (日本語)</label>
                            <input type="text" name="title_ja" id="edit-story-title-ja" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Title (English)</label>
                            <input type="text" name="title_en" id="edit-story-title-en" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">カテゴリ (日本語)</label>
                            <input type="text" name="category_ja" id="edit-story-cat-ja" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Category (English)</label>
                            <input type="text" name="category_en" id="edit-story-cat-en" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">画像URL / パス</label>
                            <input type="text" name="image" id="edit-story-image" class="form-control">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">公開日</label>
                            <input type="text" name="published_date" id="edit-story-date" class="form-control">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label class="text-sm font-weight-bold">注目設定</label>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" name="featured" class="custom-control-input" id="edit-story-featured" value="1">
                                <label class="custom-control-label" for="edit-story-featured">Featured表示</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">概要・サマリー (日本語)</label>
                            <textarea name="summary_ja" id="edit-story-summary-ja" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Summary (English)</label>
                            <textarea name="summary_en" id="edit-story-summary-en" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">保存する</button>
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
        $('#edit-story-image').val($(this).data('image'));
        $('#edit-story-date').val($(this).data('date'));
        $('#edit-story-featured').prop('checked', $(this).data('featured') == '1');
        $('#edit-story-summary-ja').val($(this).data('summary-ja'));
        $('#edit-story-summary-en').val($(this).data('summary-en'));
        $('#modal-edit-story').modal('show');
    });
});
</script>
@endpush
