@extends('layout.user')

@section('content')

<h3 class="mb-4">🔥 Sản phẩm nổi bật</h3>

<div class="row">

@foreach($phones as $p)
<div class="col-md-3 mb-4">
    <div class="card shadow text-center">

        <img src="/uploads/{{ $p->image }}" height="200" style="object-fit:cover">

        <div class="card-body">
            <h5>{{ $p->name }}</h5>

            <p class="text-danger fw-bold">
                {{ number_format($p->price) }} VND
            </p>

            <a href="/add/{{ $p->id }}" class="btn btn-primary w-100">
                🛒 Thêm vào giỏ
            </a>
        </div>

    </div>
</div>
@endforeach

</div>

@endsection