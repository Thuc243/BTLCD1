@extends('layout.user')

@section('content')

<h3>Đơn hàng</h3>

@foreach($orders as $o)
<p>Mã: {{ $o->id }} | {{ $o->total }}đ | {{ $o->status }}</p>
@endforeach

@endsection