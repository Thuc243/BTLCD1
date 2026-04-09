@extends('layout.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-1">Quản lý Sản phẩm</h5>
        <p class="text-muted small mb-0">{{ $phones->total() }} sản phẩm trong hệ thống</p>
    </div>
    <a href="{{ route('admin.phones.create') }}" class="btn btn-primary d-flex align-items-center gap-2 rounded-pill px-4">
        <i data-lucide="plus" size="18"></i> Thêm sản phẩm
    </a>
</div>

<!-- Search & Filter -->
<div class="card p-3 mb-4">
    <form method="GET" action="{{ route('admin.phones') }}" class="d-flex gap-3 flex-wrap">
        <div class="flex-grow-1">
            <input type="text" name="keyword" class="form-control" placeholder="🔍 Tìm kiếm sản phẩm..." 
                value="{{ request('keyword') }}" style="border-radius: 10px;">
        </div>
        <select name="category_id" class="form-select" style="max-width: 200px; border-radius: 10px;">
            <option value="">Tất cả hãng</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-dark rounded-pill px-4">Lọc</button>
        @if(request('keyword') || request('category_id'))
            <a href="{{ route('admin.phones') }}" class="btn btn-outline-secondary rounded-pill px-3">Xóa lọc</a>
        @endif
    </form>
</div>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Phân loại</th>
                    <th>Giá bán</th>
                    <th>Đã bán</th>
                    <th>Nổi bật</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($phones as $p)
                <tr>
                    <td class="ps-4 text-muted small">#{{ $p->id }}</td>
                    <td>
                        <div class="rounded bg-light p-1 d-inline-block" style="border-radius: 10px !important;">
                            <img src="{{ asset('uploads/' . $p->image) }}" width="50" height="50" 
                                class="object-fit-contain" style="border-radius: 8px;"
                                onerror="this.src='https://placehold.co/50x50/f0f0f0/999?text=Phone'">
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold" style="font-size: 14px;">{{ $p->name }}</div>
                    </td>
                    <td>
                        <span class="badge rounded-pill" style="background: #f1f5f9; color: #64748b; font-size: 12px;">
                            {{ $p->category->name ?? 'N/A' }}
                        </span>
                    </td>
                    <td>
                        <div class="fw-bold" style="color: #ef4444;">{{ number_format($p->price, 0, ',', '.') }}₫</div>
                    </td>
                    <td class="text-muted">{{ number_format($p->sold) }}</td>
                    <td>
                        @if($p->is_featured)
                            <span class="badge rounded-pill" style="background: #fef3c7; color: #d97706; border: 1px solid #fbbf24;">🔥 HOT</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.phones.edit', $p->id) }}" class="btn btn-sm btn-light border rounded-pill px-3" title="Sửa">
                                <i data-lucide="edit-3" size="14"></i> Sửa
                            </a>
                            <a href="{{ route('admin.phones.delete', $p->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" title="Xóa">
                                <i data-lucide="trash-2" size="14"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $phones->links() }}
</div>

@endsection