@extends('layout.user')

@section('content')

<h3>📦 Đơn hàng của bạn</h3>

<table class="table table-bordered text-center">

<tr>
<th>ID</th>
<th>Tổng tiền</th>
<th>Trạng thái</th>
<th>Thanh toán</th>
</tr>

@foreach($orders as $o)
<tr>
<td>{{ $o->id }}</td>
<td>{{ number_format($o->total) }}</td>
<td>
<span class="badge bg-warning">{{ $o->status }}</span>
</td>
<td>{{ $o->payment_method }}</td>
</tr>
@endforeach

</table>

@endsection
