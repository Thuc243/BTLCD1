@extends('layout.user')

@section('content')

<h3>📱 Sản phẩm theo hãng</h3>

<div class="row">
@foreach($phones as $p)
<div class="col-md-3 mb-4">
<div class="card shadow">

<img src="/uploads/{{ $p->image }}" height="200">

<div class="card-body text-center">
<h6>{{ $p->name }}</h6>
<p class="text-danger">{{ number_format($p->price) }}đ</p>

<a href="/add/{{ $p->id }}" class="btn btn-primary">Mua</a>
</div>

</div>
</div>
@endforeach
</div>

@endsection