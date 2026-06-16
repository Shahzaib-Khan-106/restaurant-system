@extends('layouts.app')

@section('content')
<h1>Order Menu</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('order.place') }}" method="POST">
    @csrf
    <table border="1" cellpadding="8">
        <tr>
            <th>Item</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Quantity</th>
        </tr>
        @foreach($menuItems as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->category }}</td>
            <td>
                <input type="number" name="menu_items[{{ $item->id }}]" value="0" min="0">
            </td>
        </tr>
        @endforeach
    </table>
    <button type="submit">Place Order</button>
</form>
@endsection
