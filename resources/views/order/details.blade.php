@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center"
             style="background: linear-gradient(90deg, #00c6ff, #0072ff);">
            <h2 class="fw-bold">📦 Placed Orders</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['customer'] }}</td>
                            <td>{{ $order['email'] }}</td>
                            <td>{{ $order['phone'] }}</td>
                            <td><span class="badge bg-info text-dark">{{ $order['status'] }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
