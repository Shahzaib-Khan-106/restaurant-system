@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success text-center fw-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" 
             style="background: linear-gradient(90deg, #ff6a00, #ee0979);">
            <h2 class="fw-bold">🍽️ Order Menu</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('order.place') }}" method="GET">
                @csrf
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menuItems as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="text-success fw-bold">
                                    {{ number_format($item->price, 2) }}
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $item->category }}
                                    </span>
                                </td>
                                <td>
                                    <input type="number" 
                                           name="menu_items[{{ $item->id }}]" 
                                           class="form-control text-center" 
                                           min="0" value="0">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <button type="submit" 
                            class="btn btn-lg text-white fw-bold shadow-sm" 
                            style="background: linear-gradient(90deg, #00c6ff, #0072ff);">
                        ✅ Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body { background-color: #f8f9fa; }
    .table-hover tbody tr:hover {
        background-color: #ffe8e8;
        transition: 0.3s ease;
    }
</style>
@endsection
