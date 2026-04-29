@extends('layout.admin')

@section('content')

<div class="mb-4">
    <h5 class="fw-bold mb-1">Quản lý Đơn hàng</h5>
    <p class="text-muted small mb-0">Theo dõi và cập nhật trạng thái đơn hàng từ khách hàng.</p>
</div>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
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
                @forelse($orders as $o)
                <tr>
                    <td class="ps-4">
                        <div class="fw-bold" style="font-size: 13px;">#ORD-{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</div>
                        <div class="text-muted" style="font-size: 11px;">{{ $o->created_at->format('H:i d/m/Y') }}</div>
                    </td>
                    <td>
                        <div class="fw-semibold" style="font-size: 13px;">{{ $o->user->name ?? 'N/A' }}</div>
                        <div class="text-muted" style="font-size: 11px;">{{ $o->user->email ?? '' }}</div>
                        @if($o->phone_number)
                            <div class="text-muted" style="font-size: 11px;">📞 {{ $o->phone_number }}</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-size: 12px; max-width: 200px;">
                            @foreach($o->items as $item)
                                <div class="mb-1 text-truncate">• {{ $item->phone->name ?? 'Đã xóa' }} <span class="text-muted">(x{{ $item->quantity }})</span></div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold" style="color: var(--primary);">{{ number_format($o->total, 0, ',', '.') }}₫</div>
                    </td>
                    <td>
                        <span class="badge rounded-pill" style="background: #eff6ff; color: #2563eb; border: 1px solid #93c5fd; font-size: 11px;">
                            {{ $o->payment_method == 'COD' ? '💵 COD' : '📱 QR' }}
                        </span>
                    </td>
                    <td>
                        @if($o->status == 'pending')
                            <span class="badge rounded-pill" style="background: #fef3c7; color: #d97706; border: 1px solid #fbbf24;">⏳ Đang chờ</span>
                        @elseif($o->status == 'completed')
                            <div class="d-flex flex-column gap-1">
                                <span class="badge rounded-pill" style="background: #d1fae5; color: #059669; border: 1px solid #34d399;">✅ Hoàn tất</span>
                                @if($o->delivery_image)
                                    <a href="{{ asset('uploads/delivery/' . $o->delivery_image) }}" target="_blank" class="badge rounded-pill text-decoration-none" style="background: #e0e7ff; color: #4338ca; border: 1px solid #a5b4fc; font-size: 10px;">
                                        <i data-lucide="image" size="10" class="me-1"></i> Xem ảnh giao hàng
                                    </a>
                                @endif
                            </div>
                        @else
                            <span class="badge rounded-pill" style="background: #fee2e2; color: #dc2626; border: 1px solid #f87171;">❌ Đã hủy</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm border rounded-pill px-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" style="font-size: 12px;">
                                Xử lý
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius: 12px; padding: 6px;">
                                @if($o->status != 'completed')
                                    <li><a class="dropdown-item rounded d-flex align-items-center gap-2 py-2" style="font-size: 13px; color: #059669;" href="{{ route('admin.orders.status', [$o->id, 'completed']) }}">
                                        <i data-lucide="check-circle" size="15"></i> Hoàn tất
                                    </a></li>
                                @endif
                                @if($o->status != 'cancelled')
                                    <li><a class="dropdown-item rounded d-flex align-items-center gap-2 py-2" style="font-size: 13px; color: #d97706;" href="{{ route('admin.orders.status', [$o->id, 'cancelled']) }}">
                                        <i data-lucide="x-circle" size="15"></i> Hủy đơn
                                    </a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item rounded d-flex align-items-center gap-2 py-2" style="font-size: 13px; color: #dc2626;" 
                                    href="{{ route('admin.orders.delete', $o->id) }}" onclick="return confirm('Xóa vĩnh viễn đơn hàng này?')">
                                    <i data-lucide="trash-2" size="15"></i> Xóa
                                </a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i data-lucide="inbox" size="40" class="mb-2 opacity-25"></i>
                        <p>Chưa có đơn hàng nào.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection