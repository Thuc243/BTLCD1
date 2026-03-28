@extends('layout.admin')

@section('content')

<h3>Quản lý khách hàng</h3>

<table class="table table-bordered text-center">

<tr>
<th>ID</th>
<th>Tên</th>
<th>Email</th>
</tr>

@foreach($users as $u)
<tr>
<td>{{ $u->id }}</td>
<td>{{ $u->name }}</td>
<td>{{ $u->email }}</td>
</tr>
@endforeach

</table>

@endsection