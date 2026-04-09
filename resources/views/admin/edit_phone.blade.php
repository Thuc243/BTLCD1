@extends('layout.admin')

@section('content')

<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="font-size: 13px;">
            <li class="breadcrumb-item"><a href="{{ route('admin.phones') }}" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Chỉnh sửa</li>
        </ol>
    </nav>
    <h5 class="fw-bold mb-1">Chỉnh sửa sản phẩm</h5>
    <p class="text-muted small mb-0">Cập nhật thông tin chi tiết cho sản phẩm #{{ $phone->id }}</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card p-4">
            <form action="{{ route('admin.phones.update', $phone->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" style="font-size: 13px;">Tên sản phẩm *</label>
                        <input type="text" name="name" class="form-control" value="{{ $phone->name }}" required style="border-radius: 10px;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" style="font-size: 13px;">Giá bán (VNĐ) *</label>
                        <input type="number" name="price" class="form-control" value="{{ $phone->price }}" required style="border-radius: 10px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Hãng sản xuất *</label>
                    <select name="category_id" class="form-select" required style="border-radius: 10px;">
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ $phone->category_id == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Thay đổi ảnh sản phẩm</label>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" style="border-radius: 10px;">
                    <div class="form-text small">Để trống nếu không muốn thay đổi ảnh hiện tại.</div>
                    
                    <div class="mt-3 d-flex gap-4 align-items-center">
                        <div>
                            <p class="small text-muted mb-1">Ảnh hiện tại:</p>
                            <img src="{{ asset('uploads/' . $phone->image) }}" width="120" class="rounded border p-1 bg-light"
                                onerror="this.src='https://placehold.co/120x120/f0f0f0/999?text=Phone'">
                        </div>
                        <div id="preview-container" style="display:none;">
                            <p class="small mb-1" style="color: var(--primary);">Ảnh mới:</p>
                            <img id="preview" src="#" width="120" class="rounded border p-1">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="4" style="border-radius: 10px;">{{ $phone->description }}</textarea>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" value="1" {{ $phone->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="isFeatured" style="font-size: 13px;">
                            🔥 Sản phẩm nổi bật
                        </label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill fw-bold">
                        <i data-lucide="save" size="16" class="me-1"></i> Cập nhật
                    </button>
                    <a href="{{ route('admin.phones') }}" class="btn btn-light border px-4 rounded-pill">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card p-4" style="background: #f8fafc;">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                <i data-lucide="info" size="18"></i> Thông tin sản phẩm
            </h6>
            <div class="small text-muted">
                <div class="mb-3">
                    <strong>Ngày tạo:</strong><br>
                    {{ $phone->created_at->format('d/m/Y H:i') }}
                </div>
                <div class="mb-3">
                    <strong>Cập nhật cuối:</strong><br>
                    {{ $phone->updated_at->format('d/m/Y H:i') }}
                </div>
                <div>
                    <strong>Lượt bán:</strong><br>
                    {{ number_format($phone->sold) }} sản phẩm
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event){
    const input = event.target;
    const preview = document.getElementById('preview');
    const container = document.getElementById('preview-container');
    if(input.files && input.files[0]){
        preview.src = URL.createObjectURL(input.files[0]);
        container.style.display = 'block';
    }
}
</script>

@endsection