<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $shop->shop_name }}</title>
</head>
<body>
    <h1>{{ $shop->shop_name }}</h1>
    <p>所持金: {{ number_format($shop->money) }} 円</p>
    <p>{{ $shop->day }} 日目</p>
    <p>店舗Lv: {{ $shop->shop_level }}</p>
    <p>評判: {{ $shop->reputation }}</p>
</body>
</html>