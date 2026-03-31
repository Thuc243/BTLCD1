@extends('layout.user')

@section('content')

<h3>🛒 Giỏ hàng</h3>

<table class="table bg-white">
<tr>
<th>Tên</th>
<th>Giá</th>
<th>Số lượng</th>
<th></th>
</tr>

@foreach($cart as $id => $item)
<tr>
<td>{{ $item['name'] }}</td>
<td>{{ $item['price'] }}</td>
<td>{{ $item['qty'] }}</td>
<td>
<a href="/remove/{{ $id }}" class="btn btn-danger">Xóa</a>
</td>
</tr>
@endforeach

</table>

<a href="/checkout" class="btn btn-success">Thanh toán</a>

@endsection