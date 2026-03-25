@extends('layout')

@section('content')

<h2 class="text-center mb-4">
Thêm điện thoại
</h2>

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow p-4">

<form action="/phones/store"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Tên điện thoại</label>

<input type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Giá</label>

<input type="number"
name="price"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Ảnh điện thoại</label>

<input type="file"
name="image"
class="form-control"
required>

</div>

<button class="btn btn-success w-100">
Thêm điện thoại
</button>

</form>

</div>

</div>

</div>

@endsection