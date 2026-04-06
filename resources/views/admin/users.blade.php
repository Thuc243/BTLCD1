@extends('layout.admin')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-0">Quản lý Người dùng</h4>
    <p class="text-muted small">Danh sách khách hàng và quản trị viên trong hệ thống.</p>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Người dùng</th>
                    <th>Vai trò</th>
                    <th>Ngày tham gia</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td class="ps-4 text-muted small">#U-{{ $u->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i data-lucide="user" size="20"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $u->name }}</div>
                                <div class="text-muted small">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($u->role == 'admin')
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1">Quản trị viên</span>
                        @else
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1">Khách hàng</span>
                        @endif
                    </td>
                    <td class="text-muted small">
                        {{ $u->created_at->format('d/m/Y') }}
                    </td>
                    <td class="text-end pe-4">
                        <button class="btn btn-light btn-sm border px-3">Chi tiết</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection