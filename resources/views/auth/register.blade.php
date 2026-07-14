<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザ登録</title>
</head>
<body>
    <h1>ユーザ登録</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div>
            <label>名前</label><br>
            <input type="text" name="name">
        </div>
        <br>
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
        
        <button type="submit">登録する</button>
    </form>
</body>
</html>