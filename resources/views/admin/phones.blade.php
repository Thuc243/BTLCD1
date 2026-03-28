@extends('layout.admin')

@section('content')
<a href="/admin/phones/create" class="btn btn-success mb-3">
    ➕ Thêm sản phẩm
</a>
<h3>Quản lý sản phẩm</h3>

<table class="table table-bordered text-center">

<tr>
<th>ID</th>
<th>Tên</th>
<th>Giá</th>
<th>Ảnh</th>
<th>Mô tả</th>
<th>Action</th>
</tr>

@foreach($phones as $p)
<tr>
<td>{{ $p->id }}</td>
<td>{{ $p->name }}</td>
<td>{{ number_format($p->price) }}</td>

<td>
@if($p->image)
<img src="/uploads/{{ $p->image }}" width="80">
@endif
</td>

<td>{{ $p->description }}</td>

<td>
<a href="/admin/phones/delete/{{ $p->id }}" 
   class="btn btn-danger btn-sm"
   onclick="return confirm('Xóa?')">
   Xóa
</a>
</td>

</tr>
@endforeach

</table>

@endsection
