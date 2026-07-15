@extends('layouts.app')

@section('title', '営業結果')

@section('content')

<h2>営業結果</h2>

<p>来客数：{{ $result['customers'] }} 人</p>
<p>売上：{{ number_format($result['sales']) }} 円</p>
<p>仕入れ：{{ number_format($result['expense']) }} 円</p>
<p>利益：{{ number_format($result['profit']) }} 円</p>

<hr>

<a href="{{ route('dashboard') }}">
    ダッシュボードへ戻る
</a>

@endsection