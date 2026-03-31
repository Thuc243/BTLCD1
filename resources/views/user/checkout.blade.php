@extends('layout.user')

@section('content')

<h3>Thanh toán</h3>

<form method="POST" action="/order">
@csrf

<label>Phương thức:</label>
<select name="payment" class="form-control mb-3">
<option value="COD">Thanh toán khi nhận hàng</option>
<option value="QR">Quét QR</option>
</select>

<img src="/qr.png" width="200">

<button class="btn btn-primary mt-3">Đặt hàng</button>

</form>

@endsection