@extends('layout.admin')

@section('content')

<h3>➕ Thêm sản phẩm</h3>

<form method="POST" action="/admin/phones/store" enctype="multipart/form-data">
@csrf

<div class="mb-3">
<label>Tên sản phẩm</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Giá</label>
<input type="number" name="price" class="form-control" required>
</div>

<div class="mb-3">
<label>Hình ảnh</label>
<input type="file" name="image" class="form-control">
</div>

<div class="mb-3">
<label>Mô tả</label>
<textarea name="description" class="form-control"></textarea>
</div>

<button class="btn btn-primary">Lưu</button>

</form>

@endsection