@extends('layouts.adminlte')

@section('title', 'よくある質問管理')
@section('page_title', 'よくある質問管理 (FAQs)')

@section('breadcrumb')
    <li class="breadcrumb-item active">よくある質問管理</li>
@endsection

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-question-circle text-primary mr-2"></i>よくある質問 (FAQ) 一覧
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-success font-weight-bold" data-toggle="modal" data-target="#modal-create-faq">
                <i class="fas fa-plus mr-1"></i> 新しい質問を追加
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th style="width: 160px;">カテゴリ</th>
                        <th>質問内容 (日 / 英)</th>
                        <th>回答サマリー</th>
                        <th style="width: 80px;" class="text-center">順序</th>
                        <th style="width: 120px;" class="text-right">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td class="align-middle text-muted font-weight-bold">{{ $faq->id }}</td>
                            <td class="align-middle">
                                <span class="badge badge-secondary text-xs">{{ $faq->category_ja }}</span>
                            </td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark">{{ $faq->question_ja }}</div>
                                <div class="text-xs text-muted">{{ $faq->question_en }}</div>
                            </td>
                            <td class="align-middle text-sm text-muted" style="max-width: 350px;">
                                <div class="text-truncate">{{ $faq->answer_ja }}</div>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge badge-light border">{{ $faq->sort_order }}</span>
                            </td>
                            <td class="align-middle text-right text-nowrap">
                                <button type="button" class="btn btn-sm btn-primary btn-edit-faq"
                                        data-id="{{ $faq->id }}"
                                        data-cat-ja="{{ $faq->category_ja }}"
                                        data-cat-en="{{ $faq->category_en }}"
                                        data-q-ja="{{ $faq->question_ja }}"
                                        data-q-en="{{ $faq->question_en }}"
                                        data-a-ja="{{ $faq->answer_ja }}"
                                        data-a-en="{{ $faq->answer_en }}"
                                        data-sort="{{ $faq->sort_order }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="/admin/faqs/{{ $faq->id }}/delete" method="POST" class="d-inline" onsubmit="return confirm('本当にこのFAQを削除しますか？');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                登録されている質問はありません。
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
<!-- Create FAQ Modal -->
<div class="modal fade" id="modal-create-faq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="/admin/faqs">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-plus-circle mr-2"></i>新しいFAQの追加
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">カテゴリ (日本語)</label>
                            <input type="text" name="category_ja" class="form-control" value="特定技能・ビザ手続" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Category (English)</label>
                            <input type="text" name="category_en" class="form-control" value="SSW & Visa Procedures" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">質問 (日本語)</label>
                            <textarea name="question_ja" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Question (English)</label>
                            <textarea name="question_en" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">回答 (日本語)</label>
                            <textarea name="answer_ja" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Answer (English)</label>
                            <textarea name="answer_en" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm font-weight-bold">表示優先度 (Sort)</label>
                        <input type="number" name="sort_order" class="form-control" value="0" style="max-width: 140px;">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-success font-weight-bold">追加する</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit FAQ Modal -->
<div class="modal fade" id="modal-edit-faq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-edit-faq" method="POST" action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>FAQの編集
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">カテゴリ (日本語)</label>
                            <input type="text" name="category_ja" id="edit-faq-cat-ja" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Category (English)</label>
                            <input type="text" name="category_en" id="edit-faq-cat-en" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">質問 (日本語)</label>
                            <textarea name="question_ja" id="edit-faq-q-ja" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Question (English)</label>
                            <textarea name="question_en" id="edit-faq-q-en" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">回答 (日本語)</label>
                            <textarea name="answer_ja" id="edit-faq-a-ja" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-sm font-weight-bold">Answer (English)</label>
                            <textarea name="answer_en" id="edit-faq-a-en" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-sm font-weight-bold">表示優先度 (Sort)</label>
                        <input type="number" name="sort_order" id="edit-faq-sort" class="form-control" style="max-width: 140px;">
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
    $('.btn-edit-faq').on('click', function() {
        var id = $(this).data('id');
        $('#form-edit-faq').attr('action', '/admin/faqs/' + id);
        $('#edit-faq-cat-ja').val($(this).data('cat-ja'));
        $('#edit-faq-cat-en').val($(this).data('cat-en'));
        $('#edit-faq-q-ja').val($(this).data('q-ja'));
        $('#edit-faq-q-en').val($(this).data('q-en'));
        $('#edit-faq-a-ja').val($(this).data('a-ja'));
        $('#edit-faq-a-en').val($(this).data('a-en'));
        $('#edit-faq-sort').val($(this).data('sort'));
        $('#modal-edit-faq').modal('show');
    });
});
</script>
@endpush
