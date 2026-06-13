@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">🍴 Menu for {{ $restaurant->name }}</h3>
            <a href="{{ route('restaurants.menu_items.create', $restaurant->id) }}" class="btn btn-light text-info fw-bold">
                ➕ Add Menu Item
            </a>
        </div>

        <div class="card-body">
            <!-- Success & Error alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Filter + Sorting form -->
            <form method="GET" action="{{ route('restaurants.menu_items.index', $restaurant->id) }}" class="row g-3 mb-4">
                <div class="col-md-3">
                    <input type="text" name="category" class="form-control shadow-sm"
                           placeholder="Filter by category" value="{{ request('category') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" step="0.01" name="min_price" class="form-control shadow-sm"
                           placeholder="Min price" value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" step="0.01" name="max_price" class="form-control shadow-sm"
                           placeholder="Max price" value="{{ request('max_price') }}">
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select shadow-sm">
                        <option value="">Sort by...</option>
                        <option value="name" {{ request('sort')=='name' ? 'selected' : '' }}>Name</option>
                        <option value="price" {{ request('sort')=='price' ? 'selected' : '' }}>Price</option>
                        <option value="category" {{ request('sort')=='category' ? 'selected' : '' }}>Category</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="direction" class="form-select shadow-sm">
                        <option value="asc" {{ request('direction')=='asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('direction')=='desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-outline-dark w-100 shadow-sm">🔍 Apply Filters</button>
                </div>
            </form>

            <!-- Menu items list -->
            @if($menuItems->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price (₨)</th>
                                <th>Category</th>
                                <th style="width: 160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menuItems as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>
                                        <a href="{{ route('menu_items.edit', $item->id) }}" 
                                           class="btn btn-sm btn-warning me-1">✏️ Edit</a>
                                        <form action="{{ route('menu_items.destroy', $item->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">🗑 Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination links -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $menuItems->links() }}
                </div>
            @else
                <div class="alert alert-secondary text-center py-4 shadow-sm">
                    <h5 class="mb-0">⚠️ No menu items found for this restaurant.</h5>
                    <p class="text-muted mb-0">Try adding a new one using the button above.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
