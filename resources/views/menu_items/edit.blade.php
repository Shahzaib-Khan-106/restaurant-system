@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h3 class="mb-0">✏️ Edit Menu Item for {{ $restaurant->name }}</h3>
            <a href="{{ route('restaurants.menu_items.index', $restaurant->id) }}" class="btn btn-light text-dark fw-bold">
                ⬅ Back to Menu
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('menu_items.update', $menuItem->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Item Name</label>
                    <input type="text" name="name" class="form-control shadow-sm" value="{{ old('name', $menuItem->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control shadow-sm" rows="3">{{ old('description', $menuItem->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Price (₨)</label>
                    <input type="number" step="0.01" name="price" class="form-control shadow-sm" value="{{ old('price', $menuItem->price) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Category</label>
                    <input type="text" name="category" class="form-control shadow-sm" value="{{ old('category', $menuItem->category) }}">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">💾 Update Item</button>
                    <a href="{{ route('restaurants.menu_items.index', $restaurant->id) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
