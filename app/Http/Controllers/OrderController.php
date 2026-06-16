<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class OrderController extends Controller
{
    // Show all menu items for ordering
    public function showMenu()
    {
        // Fetch all menu items from your existing database
        $menuItems = MenuItem::all();
        return view('order.menu', compact('menuItems'));
    }

    // Handle order submission (placeholder logic for now)
    public function placeOrder(Request $request)
    {
        // Later you can add full order saving logic here
        return redirect()->route('order.menu')->with('success', 'Order placed successfully!');
    }
}
