@extends('layout.user')

@section('content')

<h3>🛒 Giỏ hàng</h3>

@if(session('cart') && count(session('cart')) > 0)

<table class="table table-bordered text-center">

<tr>
<th>Tên</th>
<th>Giá</th>
<th>Số lượng</th>
<th>Tổng</th>
<th>Hành động</th>
</tr>

@php $total = 0; @endphp

@foreach(session('cart',[]) as $id => $item)
<tr>
<td>{{ $item['name'] }}</td>
<td>{{ number_format($item['price']) }} VND</td>
<td>{{ $item['qty'] }}</td>
<td>{{ number_format($item['price'] * $item['qty']) }} VND</td>
<td>
    <a href="/remove/{{ $id }}" class="btn btn-danger btn-sm">Xóa</a>
</td>
</tr>

@php $total += $item['price'] * $item['qty']; @endphp
@endforeach

<tr>
<td colspan="3"><b>Tổng tiền</b></td>
<td class="text-danger fw-bold">{{ number_format($total) }} VND</td>
<td></td>
</tr>

</table>

<a href="/" class="btn btn-secondary">Tiếp tục mua sắm</a>
<a href="/checkout" class="btn btn-success">Thanh toán</a>

@else

<div class="alert alert-info">
    <p>Giỏ hàng rỗng</p>
    <a href="/" class="btn btn-primary">Tiếp tục mua sắm</a>
</div>

@endif

@endsection