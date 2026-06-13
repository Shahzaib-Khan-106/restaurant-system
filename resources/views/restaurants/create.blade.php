@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Restaurant</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('restaurants.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Restaurant Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter restaurant name" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Enter location" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Save Restaurant
                </button>
                <a href="{{ route('restaurants.index') }}" class="btn btn-secondary ms-2">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
