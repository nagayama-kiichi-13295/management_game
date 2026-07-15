<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ゲーム開始</title>
</head>
<body>
    <h1>ゲーム開始</h1>
    <p>店舗名を入力してください。</p>

    <form action="{{ route('shops.store') }}" method="post">
        @csrf
        <input
            type="text"
            name="shop_name"
            placeholder="例:〇〇ラーメン">
        
        <button type="submit">
            ゲーム開始
        </button>
    </form>
</body>
</html>