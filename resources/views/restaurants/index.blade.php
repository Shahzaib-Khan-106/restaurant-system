@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">🏨 Restaurants</h3>
            <a href="{{ route('restaurants.create') }}" class="btn btn-light text-primary fw-bold">
                ➕ Add Restaurant
            </a>
        </div>

        <div class="card-body">
            <!-- Search bar -->
            <form method="GET" action="{{ route('restaurants.index') }}" class="row g-3 mb-4">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control form-control-lg shadow-sm"
                           placeholder="🔍 Search by name or location..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-dark btn-lg shadow-sm">Search</button>
                </div>
            </form>

            <!-- Restaurant list -->
            @if($restaurants->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Phone</th>
                                <th style="width: 220px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($restaurants as $restaurant)
                                <tr>
                                    <td class="fw-semibold">{{ $restaurant->name }}</td>
                                    <td>{{ $restaurant->location }}</td>
                                    <td>{{ $restaurant->phone }}</td>
                                    <td>
                                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" 
                                           class="btn btn-sm btn-warning me-1">✏️ Edit</a>
                                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger me-1">🗑 Delete</button>
                                        </form>
                                        <a href="{{ route('restaurants.menu_items.index', $restaurant->id) }}" 
                                           class="btn btn-sm btn-info text-white">🍽 View Menu</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $restaurants->links() }}
                </div>
            @else
                <div class="alert alert-secondary text-center py-4 shadow-sm">
                    <h5 class="mb-0">😔 No restaurants found.</h5>
                    <p class="text-muted mb-0">Try adding a new one using the button above.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
