@extends('layout.user')

@section('content')

<!-- BANNER -->
<img src="https://cdn.tgdd.vn/2023/12/banner/1200-300-1200x300.png" class="w-100 mb-3">

<!-- SẢN PHẨM NỔI BẬT -->
<h4>⭐ SẢN PHẨM NỔI BẬT</h4>
<div class="row">
@foreach($featured as $p)
    @include('user.card')
@endforeach
</div>

<!-- BÁN CHẠY -->
<h4>🔥 BÁN CHẠY</h4>
<div class="row">
@foreach($bestSeller as $p)
    @include('user.card')
@endforeach
</div>

<!-- TẤT CẢ -->
<h4>📱 TẤT CẢ SẢN PHẨM</h4>
<div class="row">
@foreach($phones as $p)
    @include('user.card')
@endforeach
</div>

@endsection