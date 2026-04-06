@extends('layout.admin')

@section('content')

<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.phones') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Chỉnh sửa</li>
        </ol>
    </nav>
    <h4 class="fw-bold mb-0">Chỉnh sửa sản phẩm</h4>
    <p class="text-muted small">Cập nhật thông tin chi tiết cho sản phẩm #{{ $phone->id }}</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('admin.phones.update', $phone->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="{{ $phone->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Giá bán (VNĐ)</label>
                        <input type="number" name="price" class="form-control" value="{{ $phone->price }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Hãng sản xuất</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ $phone->category_id == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Thay đổi ảnh sản phẩm</label>
                    <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                    <div class="form-text small">Để trống nếu không muốn thay đổi ảnh hiện tại.</div>
                    
                    <div class="mt-3 d-flex gap-4 align-items-center">
                        <div>
                            <p class="small text-muted mb-1">Ảnh hiện tại:</p>
                            <img src="{{ asset('uploads/' . $phone->image) }}" width="120" class="rounded border p-1 bg-light">
                        </div>
                        <div id="preview-container" style="display:none;">
                            <p class="small text-muted mb-1 text-primary">Ảnh mới:</p>
                            <img id="preview" src="#" width="120" class="rounded border p-1">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="5">{{ $phone->description }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Cập nhật thông tin</button>
                    <a href="{{ route('admin.phones') }}" class="btn btn-light border px-4 py-2 text-secondary">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 bg-light h-100">
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
                    {{ $phone->sold }} sản phẩm
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