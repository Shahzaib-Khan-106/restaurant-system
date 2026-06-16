@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center"
             style="background: linear-gradient(90deg, #ff6a00, #ee0979);">
            <h2 class="fw-bold">✅ Order Confirmation</h2>
        </div>
        <div class="card-body text-center">
            <p class="fw-semibold">Thank you, {{ $data['name'] }}!</p>
            <p>Your order details have been recorded.</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
            <a href="{{ route('order.menu') }}" class="btn btn-primary mt-3">Back to Menu</a>
        </div>
    </div>
</div>
@endsection
