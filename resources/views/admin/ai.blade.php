@extends('layouts.adminlte')

@section('title', 'Sakana AI 設定・診断')
@section('page_title', 'Sakana AI 設定・接続診断')

@section('breadcrumb')
    <li class="breadcrumb-item active">Sakana AI 設定</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card card-outline card-purple">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-robot text-purple mr-2"></i>Sakana AI モデル & APIキー設定
                </h3>
            </div>
            <form action="{{ route('admin.sakana.config') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="callout callout-info py-2 px-3 mb-3 text-xs">
                        日本発フロンティアAI「Sakana AI」の EvoVLM-JP / Llama-3-Evo などの日本語特化モデルを活用し、サイト訪問者の多言語自動求人マッチングや介護相談AIチャットを提供します。
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-sm font-weight-bold">使用モデル (Sakana AI Model)</label>
                        <select name="model" class="form-control">
                            <option value="sakana-ai/EvoVLM-JP-v1-7B" selected>sakana-ai/EvoVLM-JP-v1-7B (推奨: 日本語マルチモーダル高速モデル)</option>
                            <option value="sakana-ai/Llama-3-Evo-8B-Instruct">sakana-ai/Llama-3-Evo-8B-Instruct (対話・就労相談)</option>
                            <option value="sakana-ai/Evo-Text-JP-13B">sakana-ai/Evo-Text-JP-13B (高度翻訳・公的書類生成)</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-sm font-weight-bold">Sakana AI API Key</label>
                        <div class="input-group">
                            <input type="password" name="apiKey" class="form-control" placeholder="sk-..." value="{{ env('SAKANA_AI_API_KEY', '') }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key text-muted"></i></span>
                            </div>
                        </div>
                        <small class="text-muted">※ 未設定時は組み込みのインテリジェント・フォールバックエンジンが自動稼働します。</small>
                    </div>
                </div>

                <div class="card-footer bg-light text-right">
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-save mr-1"></i> 設定を保存
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-plug text-success mr-2"></i>API 接続テスト・動作確認
                </h3>
            </div>
            <div class="card-body">
                <p class="text-sm text-muted">
                    現在の設定で Sakana AI サーバーとの疎通確認を行います。テストプロンプトを送信し、レイテンシと応答内容を診断します。
                </p>

                <div class="form-group">
                    <label class="text-xs font-weight-bold text-secondary">テスト質問</label>
                    <input type="text" id="ai-test-prompt" class="form-control" value="ミランス合同会社の介護特定技能サポートについて教えてください。">
                </div>

                <button type="button" id="btn-run-ai-test" class="btn btn-success font-weight-bold mb-3">
                    <i class="fas fa-paper-plane mr-1"></i> 疎通テストを実行
                </button>

                <div id="ai-test-result" style="display: none;" class="p-3 bg-light rounded border text-sm">
                    <div class="d-flex align-items-center mb-2">
                        <span id="ai-test-status" class="badge badge-success mr-2">200 OK</span>
                        <span id="ai-test-time" class="text-xs text-muted">Response time: 240ms</span>
                    </div>
                    <div id="ai-test-reply" class="text-dark" style="white-space: pre-wrap;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#btn-run-ai-test').on('click', function() {
        var $btn = $(this);
        var prompt = $('#ai-test-prompt').val();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> 診断中...');
        $('#ai-test-result').hide();

        $.ajax({
            url: '/api/sakana/chat',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ message: prompt }),
            success: function(res) {
                $btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> 疎通テストを実行');
                $('#ai-test-status').removeClass('badge-danger').addClass('badge-success').text('200 OK (Connected)');
                $('#ai-test-time').text('Model: ' + (res.model || 'Sakana AI Engine'));
                $('#ai-test-reply').text(res.reply || res.text || JSON.stringify(res));
                $('#ai-test-result').slideDown();
            },
            error: function(err) {
                $btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> 疎通テストを実行');
                $('#ai-test-status').removeClass('badge-success').addClass('badge-danger').text('Error ' + err.status);
                $('#ai-test-reply').text('エラーが発生しました: ' + (err.responseJSON ? err.responseJSON.error : err.statusText));
                $('#ai-test-result').slideDown();
            }
        });
    });
});
</script>
@endpush
