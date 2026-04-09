@extends('layout.admin')

@section('content')

<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="font-size: 13px;">
            <li class="breadcrumb-item"><a href="{{ route('admin.phones') }}" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
    </nav>
    <h5 class="fw-bold mb-0">Thêm sản phẩm mới</h5>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card p-4">
            <form action="{{ route('admin.phones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" style="font-size: 13px;">Tên sản phẩm *</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên điện thoại..." required style="border-radius: 10px;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" style="font-size: 13px;">Giá bán (VNĐ) *</label>
                        <input type="number" name="price" class="form-control" placeholder="Ví dụ: 20000000" required style="border-radius: 10px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Hãng sản xuất *</label>
                    <select name="category_id" class="form-select" required style="border-radius: 10px;">
                        <option value="">-- Chọn hãng --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" style="border-radius: 10px;">
                    <div class="form-text small">Nên sử dụng ảnh nền trắng, kích thước 600x600px.</div>
                    <img id="preview" src="#" style="display:none; margin-top:15px;" width="150" class="rounded border p-1">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Mô tả chi tiết cấu hình, tính năng..." style="border-radius: 10px;"></textarea>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" value="1">
                        <label class="form-check-label fw-semibold" for="isFeatured" style="font-size: 13px;">
                            🔥 Đánh dấu là sản phẩm nổi bật
                        </label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill fw-bold">
                        <i data-lucide="save" size="16" class="me-1"></i> Lưu sản phẩm
                    </button>
                    <a href="{{ route('admin.phones') }}" class="btn btn-light border px-4 rounded-pill">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card p-4" style="background: #f0f7ff;">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="color: var(--primary);">
                <i data-lucide="help-circle" size="18"></i> Hướng dẫn
            </h6>
            <ul class="small text-muted ps-3">
                <li class="mb-3">Đảm bảo tên sản phẩm chính xác, bao gồm dung lượng (VD: 128GB).</li>
                <li class="mb-3">Giá bán nên là giá niêm yết mới nhất (tính bằng đồng).</li>
                <li class="mb-3">Ảnh sản phẩm sẽ hiển thị trên trang chủ và chi tiết.</li>
                <li>Sản phẩm nổi bật sẽ được ưu tiên hiển thị ở trang chủ.</li>
            </ul>
        </div>
    </div>
</div>

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