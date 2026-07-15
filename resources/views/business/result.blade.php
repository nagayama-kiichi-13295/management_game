@extends('layouts.app')

@section('title', '営業結果')

@section('content')

<h2>営業結果</h2>

<p>来客数：{{ $result['customers'] }} 人</p>
<p>売上：{{ number_format($result['sales']) }} 円</p>
<p>仕入れ：{{ number_format($result['expense']) }} 円</p>
<p>利益：{{ number_format($result['profit']) }} 円</p>

<h3>スキル成長</h3>
<ul>
    @foreach($shop->shopSkills as $skill)
        <li>
            {{ $skill->skill->name }}
            Lv{{ $skill->level }}
            EXP{{ $skill->exp }}/{{ 100 + (($skill->level - 1) * 50) }}
        </li>
    @endforeach
</ul>

<hr>

<a href="{{ route('dashboard') }}">
    ダッシュボードへ戻る
</a>

@endsection