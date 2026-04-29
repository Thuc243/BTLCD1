@extends('layout.user')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0"><i data-lucide="truck" class="me-2 text-primary"></i> Đơn hàng cần giao (COD)</h4>
        <span class="badge bg-primary px-3 py-2" style="font-size: 14px;">Shipper: {{ auth()->user()->name }}</span>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(count($orders) > 0)
        <div class="row g-4">
            @foreach($orders as $order)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                        <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                            <span class="fw-bold">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="badge rounded-pill" style="background: #fef3c7; color: #d97706; border: 1px solid #fbbf24;">Đang chờ giao</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i data-lucide="user" size="16" class="text-muted"></i>
                                    <span class="fw-semibold">{{ $order->customer_name ?? $order->user->name }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i data-lucide="phone" size="16" class="text-muted"></i>
                                    <span class="fw-semibold text-primary">{{ $order->phone_number ?? 'Không có SĐT' }}</span>
                                </div>
                                <div class="d-flex align-items-start gap-2">
                                    <i data-lucide="map-pin" size="16" class="text-muted mt-1"></i>
                                    <span style="font-size: 14px;">{{ $order->address ?? 'Không có địa chỉ' }}</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted" style="font-size: 12px; text-transform: uppercase; font-weight: 700; margin-bottom: 8px;">Sản phẩm</div>
                                @foreach($order->items as $item)
                                    <div class="d-flex justify-content-between mb-1" style="font-size: 14px;">
                                        <span class="text-truncate" style="max-width: 70%;">{{ $item->quantity }}x {{ $item->phone->name ?? 'SP đã xóa' }}</span>
                                        <span class="fw-semibold">{{ number_format($item->price, 0, ',', '.') }}₫</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <span class="text-muted fw-semibold">Thu tiền mặt:</span>
                                <span class="fw-bold text-danger fs-5">{{ number_format($order->total, 0, ',', '.') }}₫</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 p-3 pt-0">
                            <button type="button" class="btn w-100 fw-bold" style="background: #10b981; color: white; padding: 12px; border-radius: 12px;" data-bs-toggle="modal" data-bs-target="#completeModal{{ $order->id }}">
                                <i data-lucide="camera" size="18" class="me-1"></i> Chụp ảnh giao thành công
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Upload Ảnh -->
                <div class="modal fade" id="completeModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 16px; border: none;">
                            <form action="{{ url('/shipper/orders/' . $order->id . '/complete') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h5 class="modal-title fw-bold">Xác nhận giao hàng #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body py-4">
                                    <p class="text-muted mb-4" style="font-size: 14px;">Vui lòng chụp ảnh gói hàng hoặc địa điểm giao hàng thành công để xác minh với hệ thống.</p>
                                    
                                    <div class="upload-area mb-3 text-center" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 30px; background: #f8fafc; cursor: pointer; transition: all 0.2s;" onclick="document.getElementById('imageInput{{ $order->id }}').click()">
                                        <i data-lucide="image-plus" size="40" class="text-muted mb-2"></i>
                                        <div class="fw-semibold text-primary">Chọn ảnh hoặc chụp ảnh mới</div>
                                        <div class="text-muted" style="font-size: 12px;">Hỗ trợ JPG, PNG (Tối đa 5MB)</div>
                                    </div>
                                    <input type="file" name="delivery_image" id="imageInput{{ $order->id }}" accept="image/*" capture="environment" class="d-none" required onchange="previewImage(this, 'preview{{ $order->id }}', 'area{{ $order->id }}')">
                                    
                                    <div id="preview{{ $order->id }}" class="d-none text-center">
                                        <img src="" alt="Preview" class="img-fluid rounded shadow-sm mb-2" style="max-height: 200px;">
                                        <div class="text-primary fw-semibold" style="cursor: pointer; font-size: 14px;" onclick="document.getElementById('imageInput{{ $order->id }}').click()">Thay đổi ảnh</div>
                                    </div>
                                    
                                    <div class="alert alert-warning d-flex align-items-center mt-4 mb-0" style="font-size: 13px;">
                                        <i data-lucide="alert-circle" size="16" class="me-2 text-warning"></i>
                                        Lưu ý: Xác nhận đã thu đủ số tiền <strong>{{ number_format($order->total, 0, ',', '.') }}₫</strong>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 pt-0">
                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">Xác nhận hoàn tất</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div style="width: 100px; height: 100px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <i data-lucide="check-circle" size="40" class="text-success opacity-75"></i>
            </div>
            <h4 class="fw-bold">Tuyệt vời!</h4>
            <p class="text-muted">Bạn đã giao hoàn tất tất cả các đơn hàng COD.</p>
        </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
    function previewImage(input, previewId, areaId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).classList.remove('d-none');
                document.getElementById(previewId).querySelector('img').src = e.target.result;
                input.previousElementSibling.classList.add('d-none'); // Hide upload area
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
