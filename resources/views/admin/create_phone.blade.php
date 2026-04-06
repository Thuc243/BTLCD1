@extends('layout.admin')

@section('content')

<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.phones') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-0">Thêm sản phẩm mới</h4>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('admin.phones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên điện thoại..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Giá bán (VNĐ)</label>
                        <input type="number" name="price" class="form-control" placeholder="Ví dụ: 20000000" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Hãng sản xuất</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Chọn hãng --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="form-control" onchange="previewImage(event)" required>
                    <div class="form-text small">Nên sử dụng ảnh nền trắng, kích thước 600x600px.</div>
                    <img id="preview" src="#" style="display:none; margin-top:15px;" width="150" class="rounded border p-1">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Mô tả chi tiết về cấu hình, tính năng..."></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Lưu sản phẩm</button>
                    <a href="{{ route('admin.phones') }}" class="btn btn-light border px-4 py-2 text-secondary">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 bg-primary bg-opacity-10 h-100">
            <h6 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                <i data-lucide="help-circle" size="18"></i> Hướng dẫn
            </h6>
            <ul class="small text-muted ps-3">
                <li class="mb-3">Đảm bảo tên sản phẩm không chứa ký tự đặc biệt.</li>
                <li class="mb-3">Giá bán nên là giá niêm yết mới nhất (tính bằng đồng).</li>
                <li class="mb-3">Ảnh sản phẩm sẽ được hiển thị ngay trên trang chủ và chi tiết.</li>
                <li>Sau khi thêm, bạn có thể chỉnh sửa thông tin bất cứ lúc nào.</li>
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