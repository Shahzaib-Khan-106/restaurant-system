@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center"
             style="background: linear-gradient(90deg, #00c6ff, #0072ff);">
            <h2 class="fw-bold">🧾 Customer Information</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('order.confirm') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Mobile Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-lg text-white fw-bold shadow-sm"
                            style="background: linear-gradient(90deg, #ff6a00, #ee0979);">
                        🚀 Continue to Order Summary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
