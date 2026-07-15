<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ホーム</title>
</head>
<body>
    <h1>ホーム画面</h1>

    <p>ようこそ, {{ Auth::user()->name }} さん</p>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>