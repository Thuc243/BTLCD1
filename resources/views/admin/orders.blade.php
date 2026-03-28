@extends('layout.admin')

@section('content')

<h3>Quản lý đơn hàng</h3>

<table class="table table-bordered text-center">

<tr>
<th>ID</th>
<th>Khách hàng</th>
<th>Tổng tiền</th>
<th>Trạng thái</th>
<th>Thanh toán</th>
</tr>

@foreach($orders as $o)
<tr>
<td>{{ $o->id }}</td>
<td>{{ $o->user->name }}</td>
<td>{{ number_format($o->total) }} VND</td>
<td>
<span class="badge bg-warning">{{ $o->status }}</span>
</td>
<td>{{ $o->payment_method }}</td>
</tr>
@endforeach

</table>

@endsection