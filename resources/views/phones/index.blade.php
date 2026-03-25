@extends('layout')

@section('content')

<h2 class="text-center mb-4">
Danh sách điện thoại
</h2>

<div class="row">

@foreach($phones as $p)

<div class="col-md-3">

<div class="card shadow mb-4">

<img src="/images/{{$p['image']}}"
style="height:220px;object-fit:cover">

<div class="card-body text-center">

<h5>{{$p['name']}}</h5>

<p class="price">
{{number_format($p['price'])}} VNĐ
</p>

<a href="/phones/edit/{{$p['id']}}"
class="btn btn-warning btn-sm">
Sửa
</a>

</div>

</div>

</div>

@endforeach

</div>

@endsection