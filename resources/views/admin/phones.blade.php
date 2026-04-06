@extends('layout.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Quản lý Sản phẩm</h4>
    <a href="{{ route('admin.phones.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus-circle" size="18"></i> Thêm sản phẩm mới
    </a>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Phân loại</th>
                    <th>Giá bán</th>
                    <th>Đã bán</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($phones as $p)
                <tr>
                    <td class="ps-4 text-muted small">#{{ $p->id }}</td>
                    <td>
                        <div class="rounded border bg-light p-1 d-inline-block">
                            <img src="{{ asset('uploads/' . $p->image) }}" width="50" height="50" class="object-fit-contain">
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold">{{ $p->name }}</div>
                        @if($p->is_featured)
                            <span class="badge bg-warning text-dark small" style="font-size: 10px;">HOT</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-secondary opacity-75">{{ $p->category->name ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <div class="fw-bold text-danger">{{ number_format($p->price, 0, ',', '.') }}đ</div>
                    </td>
                    <td class="text-muted">
                        {{ $p->sold }} máy
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.phones.edit', $p->id) }}" class="btn btn-outline-primary btn-sm rounded-circle p-2" title="Chỉnh sửa">
                                <i data-lucide="edit-3" size="16"></i>
                            </a>
                            <a href="{{ route('admin.phones.delete', $p->id) }}" class="btn btn-outline-danger btn-sm rounded-circle p-2" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" title="Xóa">
                                <i data-lucide="trash-2" size="16"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection