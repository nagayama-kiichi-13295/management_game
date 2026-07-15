<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <label>メールアドレス</label><br>
            <input type="email" name="email">
        </div>
        <br>
        <div>
            <label>パスワード</label><br>
            <input type="password" name="password">
        </div>
        <br>
        <button type="submit">
            ログイン
        </button>
    </form>
</body>
</html>