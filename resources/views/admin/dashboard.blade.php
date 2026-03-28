@extends('layout.admin')

@section('content')

<h3>📊 Dashboard</h3>

<div class="row">

<div class="col-md-4">
<div class="card bg-primary text-white p-3">
<h5>Sản phẩm</h5>
<h3>{{ $phones }}</h3>
</div>
</div>

<div class="col-md-4">
<div class="card bg-success text-white p-3">
<h5>Đơn hàng</h5>
<h3>{{ $orders }}</h3>
</div>
</div>

<div class="col-md-4">
<div class="card bg-warning p-3">
<h5>Khách hàng</h5>
<h3>{{ $users }}</h3>
</div>
</div>

</div>

@endsection