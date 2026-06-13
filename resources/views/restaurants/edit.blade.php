@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h3 class="mb-0">✏️ Edit Restaurant</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Restaurant Name</label>
                <input type="text" name="name" class="form-control" value="{{ $restaurant->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ $restaurant->location }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ $restaurant->phone }}">
            </div>

            <button type="submit" class="btn btn-primary">💾 Update</button>
            <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">⬅ Back</a>
        </form>
    </div>
</div>
@endsection
