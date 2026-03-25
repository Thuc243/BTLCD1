@extends('layout')

@section('content')

<h2 class="text-center mb-4">
Sửa điện thoại
</h2>

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow p-4">

<div class="text-center mb-3">

<img src="/images/{{$phone['image']}}"
style="width:200px;border-radius:10px">

</div>

<div class="mb-3">

<label>Tên điện thoại</label>

<input type="text"
value="{{$phone['name']}}"
class="form-control">

</div>

<div class="mb-3">

<label>Giá</label>

<input type="text"
value="{{$phone['price']}}"
class="form-control">

</div>

<button class="btn btn-primary w-100">
Cập nhật
</button>

</div>

</div>

</div>

@endsection