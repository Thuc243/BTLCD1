@extends('layout.admin')

@section('content')

<div class="container mt-4">

    <div class="card shadow p-4">
        <h3 class="mb-4">➕ Thêm sản phẩm</h3>

        <form method="POST" action="/admin/phones/store" enctype="multipart/form-data">
        @csrf

        <!-- TÊN -->
        <div class="mb-3">
            <label class="fw-bold">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên..." required>
        </div>

        <!-- GIÁ -->
        <div class="mb-3">
            <label class="fw-bold">Giá</label>
            <input type="number" name="price" class="form-control" placeholder="Nhập giá..." required>
        </div>

        <!-- HÃNG -->
        <div class="mb-3">
            <label class="fw-bold">Hãng sản phẩm</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn hãng --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- ẢNH -->
        <div class="mb-3">
            <label class="fw-bold">Hình ảnh</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            
            <img id="preview" src="#" style="display:none; margin-top:10px;" width="120">
        </div>

        <!-- MÔ TẢ -->
        <div class="mb-3">
            <label class="fw-bold">Mô tả</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <!-- NÚT -->
        <div class="d-flex gap-2">
            <button class="btn btn-primary">💾 Lưu</button>
            <a href="/admin/phones" class="btn btn-secondary">↩ Quay lại</a>
        </div>

        </form>
    </div>

</div>

<!-- SCRIPT PREVIEW ẢNH -->
<script>
function previewImage(event){
    const input = event.target;
    const preview = document.getElementById('preview');

    if(input.files && input.files[0]){
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
}
</script>

@endsection