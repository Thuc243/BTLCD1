@extends('layout.admin')

@section('content')

<div class="mb-4">
    <h5 class="fw-bold mb-1">Quản lý Người dùng</h5>
    <p class="text-muted small mb-0">Danh sách khách hàng và quản trị viên trong hệ thống.</p>
</div>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Người dùng</th>
                    <th>Vai trò</th>
                    <th>Ngày tham gia</th>
                    <th class="text-end pe-4">Đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td class="ps-4 text-muted" style="font-size: 13px;">#{{ $u->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold"
                                style="width: 40px; height: 40px; font-size: 14px; flex-shrink: 0;
                                    background: {{ $u->role == 'admin' ? 'rgba(239,68,68,0.1)' : 'rgba(59,130,246,0.1)' }};
                                    color: {{ $u->role == 'admin' ? '#ef4444' : '#3b82f6' }};">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size: 14px;">{{ $u->name }}</div>
                                <div class="text-muted" style="font-size: 12px;">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($u->role == 'admin')
                            <span class="badge rounded-pill" style="background: #fee2e2; color: #dc2626; border: 1px solid #f87171; font-size: 11px;">
                                🛡️ Quản trị viên
                            </span>
                        @else
                            <span class="badge rounded-pill" style="background: #eff6ff; color: #2563eb; border: 1px solid #93c5fd; font-size: 11px;">
                                👤 Khách hàng
                            </span>
                        @endif
                    </td>
                    <td class="text-muted" style="font-size: 13px;">
                        {{ $u->created_at->format('d/m/Y') }}
                    </td>
                    <td class="text-end pe-4">
                        <span class="fw-semibold" style="font-size: 14px;">{{ $u->orders->count() }}</span>
                        <span class="text-muted small">đơn</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection