@extends('layout.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1">Quản lý Danh mục</h5>
        <p class="text-muted small mb-0">Thêm, sửa, xóa các hãng điện thoại.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Add Category Form -->
    <div class="col-lg-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                <i data-lucide="plus-circle" size="18" style="color: var(--primary);"></i>
                Thêm danh mục mới
            </h6>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Tên danh mục *</label>
                    <input type="text" name="name" class="form-control" placeholder="VD: Huawei, Nokia..." required style="border-radius: 10px;">
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">
                    <i data-lucide="plus" size="16" class="me-1"></i> Thêm danh mục
                </button>
            </form>

            @if($errors->any())
                <div class="alert alert-danger mt-3 border-0 py-2" style="border-radius: 10px; font-size: 13px;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Categories List -->
    <div class="col-lg-8">
        <div class="card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Tên danh mục</th>
                            <th>Số sản phẩm</th>
                            <th>Ngày tạo</th>
                            <th class="text-end pe-4">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $c)
                        <tr>
                            <td class="ps-4 text-muted" style="font-size: 13px;">#{{ $c->id }}</td>
                            <td>
                                <form action="{{ route('admin.categories.update', $c->id) }}" method="POST" class="d-flex gap-2 align-items-center edit-form-{{ $c->id }}">
                                    @csrf
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center justify-content-center rounded" 
                                            style="width: 36px; height: 36px; background: rgba(59,130,246,0.1); color: #3b82f6; flex-shrink: 0;">
                                            <i data-lucide="folder" size="16"></i>
                                        </div>
                                        <input type="text" name="name" value="{{ $c->name }}" 
                                            class="form-control form-control-sm border-0 bg-transparent fw-semibold px-1" 
                                            style="font-size: 14px; min-width: 120px;" 
                                            onfocus="this.style.background='#f1f5f9'; this.style.borderRadius='8px'; this.style.padding='4px 10px';"
                                            onblur="this.style.background='transparent'; this.style.padding='0 4px';">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3" style="font-size: 11px;" title="Lưu">
                                        <i data-lucide="check" size="13"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <span class="badge rounded-pill" style="background: #f1f5f9; color: #64748b; font-size: 12px;">
                                    {{ $c->phones_count }} sản phẩm
                                </span>
                            </td>
                            <td class="text-muted" style="font-size: 13px;">
                                {{ $c->created_at->format('d/m/Y') }}
                            </td>
                            <td class="text-end pe-4">
                                @if($c->phones_count == 0)
                                    <a href="{{ route('admin.categories.delete', $c->id) }}" 
                                        class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        onclick="return confirm('Xóa danh mục {{ $c->name }}?')" style="font-size: 12px;">
                                        <i data-lucide="trash-2" size="13"></i> Xóa
                                    </a>
                                @else
                                    <span class="text-muted small" title="Không thể xóa danh mục có sản phẩm">
                                        <i data-lucide="lock" size="14"></i>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i data-lucide="folder-open" size="40" class="mb-2 opacity-25"></i>
                                <p>Chưa có danh mục nào.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
