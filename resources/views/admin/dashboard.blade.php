@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📊 Admin Dashboard</h2>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h4>Total Restaurants</h4>
                    <p class="display-5 fw-bold text-primary">{{ $totalRestaurants }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h4>Total Menu Items</h4>
                    <p class="display-5 fw-bold text-success">{{ $totalMenuItems }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">🔥 Most Popular Categories</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($popularCategories as $cat)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $cat->category }}
                        <span class="badge bg-primary rounded-pill">{{ $cat->count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Recent Menu Item Changes -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">🕒 Recent Menu Item Changes</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($recentMenuItems as $item)
                    <li class="list-group-item">
                        <strong>{{ $item->name }}</strong> 
                        <span class="text-muted">({{ $item->updated_at->diffForHumans() }})</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Notifications -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">🔔 Notifications</h5>
        </div>
        <div class="card-body">
            @if($notifications->isEmpty())
                <p class="text-muted">No notifications yet.</p>
            @else
                <ul class="list-group">
                    @foreach($notifications as $note)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $note->message }}
                            <span class="badge bg-secondary">{{ $note->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
