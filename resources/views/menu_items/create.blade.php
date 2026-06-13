@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h3 class="mb-0">➕ Add Menu Item for {{ $restaurant->name }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('restaurants.menu_items.store', $restaurant->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Item Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter item name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Price (₨)</label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" placeholder="e.g. Drinks, Main Course">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">💾 Save Item</button>
                <a href="{{ route('restaurants.menu_items.index', $restaurant->id) }}" class="btn btn-secondary">⬅ Back to Menu</a>
            </div>
        </form>
    </div>
</div>
@endsection
