@extends('layouts.adminlte')

@section('title', '管理者パスワード変更')
@section('page_title', '管理者パスワード変更')

@section('breadcrumb')
    <li class="breadcrumb-item active">パスワード変更</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-key text-danger mr-2"></i>管理者パスワード変更 (Change Admin Password)
                </h3>
            </div>
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                <div class="card-body p-4">
                    <div class="callout callout-info py-2 px-3 mb-4 text-sm">
                        <i class="fas fa-shield-alt text-info mr-2"></i>
                        ログインアカウント（<strong>{{ Auth::user()->name ?? 'admin' }}</strong> / {{ Auth::user()->email ?? 'admin@miransh.jp' }}）の認証パスワードを安全に変更します。
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-sm font-weight-bold text-secondary">
                            現在のパスワード <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="current_password" class="form-control" placeholder="現在のパスワードを入力" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                            </div>
                        </div>
                        <small class="text-muted">※ 初期設定値: <code>admin123</code> または <code>admin</code></small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-sm font-weight-bold text-secondary">
                            新しいパスワード <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="new_password" class="form-control" placeholder="新しいパスワード（6文字以上）" required minlength="6">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key text-muted"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="text-sm font-weight-bold text-secondary">
                            新しいパスワード（確認入力） <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="もう一度入力してください" required minlength="6">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-check-double text-muted"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded border text-xs text-muted mb-3">
                        <strong>パスワード設定の要件:</strong>
                        <ul class="mb-0 pl-3 mt-1">
                            <li>最低 6 文字以上の半角英数字・記号で指定してください。</li>
                            <li>他サービスと共通のパスワード使い回しは避けてください。</li>
                            <li>変更後は直ちに新しいパスワードがすべてのログインで有効になります。</li>
                        </ul>
                    </div>
                </div>

                <div class="card-footer bg-light text-right">
                    <button type="submit" class="btn btn-danger font-weight-bold px-4">
                        <i class="fas fa-shield-alt mr-2"></i> パスワードを更新する
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title font-weight-bold text-sm">
                    <i class="fas fa-user-shield text-secondary mr-2"></i>現在の管理アカウント情報
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm mb-0 text-sm">
                    <tr>
                        <th class="bg-light" style="width: 40%;">アカウント名</th>
                        <td>{{ Auth::user()->name ?? 'admin' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">メールアドレス</th>
                        <td>{{ Auth::user()->email ?? 'admin@miransh.jp' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">権限区分</th>
                        <td><span class="badge badge-primary">Super Administrator</span></td>
                    </tr>
                    <tr>
                        <th class="bg-light">登録日</th>
                        <td>{{ Auth::user()->created_at ? \Illuminate\Support\Carbon::parse(Auth::user()->created_at)->format('Y/m/d') : '2026/01/01' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
