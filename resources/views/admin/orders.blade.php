@extends('layout.admin')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-0">Quản lý Đơn hàng</h4>
    <p class="text-muted small">Theo dõi và cập nhật trạng thái đơn hàng từ khách hàng.</p>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Mã ĐH</th>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $o)
                <tr>
                    <td class="ps-4 text-muted small">#ORD-{{ $o->id }}</td>
                    <td>
                        <div class="fw-bold">{{ $o->user->name }}</div>
                        <div class="text-muted small">{{ $o->user->email }}</div>
                    </td>
                    <td>
                        <div class="small">
                            @foreach($o->items as $item)
                                <div class="mb-1 text-nowrap">• {{ $item->phone->name }} (x{{ $quantity ?? $item->quantity }})</div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold text-primary">{{ number_format($o->total, 0, ',', '.') }}đ</div>
                        <div class="text-muted small">{{ $o->created_at->format('H:i d/m') }}</div>
                    </td>
                    <td>
                        <span class="badge bg-info bg-opacity-10 text-info text-uppercase border border-info border-opacity-25">{{ $o->payment_method }}</span>
                    </td>
                    <td>
                        @if($o->status == 'pending')
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 border border-warning border-opacity-25">Đang chờ</span>
                        @elseif($o->status == 'completed')
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 border border-success border-opacity-25">Hoàn tất</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 border border-danger border-opacity-25">Đã hủy</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Xử lý
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                @if($o->status != 'completed')
                                    <li><a class="dropdown-item text-success d-flex align-items-center gap-2" href="{{ route('admin.orders.status', [$o->id, 'completed']) }}">
                                        <i data-lucide="check-circle" size="16"></i> Hoàn tất ĐH
                                    </a></li>
                                @endif
                                @if($o->status != 'cancelled')
                                    <li><a class="dropdown-item text-warning d-flex align-items-center gap-2" href="{{ route('admin.orders.status', [$o->id, 'cancelled']) }}">
                                        <i data-lucide="x-circle" size="16"></i> Hủy đơn hàng
                                    </a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger d-flex align-items-center gap-2" href="{{ route('admin.orders.delete', $o->id) }}" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn đơn hàng này?')">
                                    <i data-lucide="trash-2" size="16"></i> Xóa đơn hàng
                                </a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection