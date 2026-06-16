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

    // Handle order submission (redirect to customer info screen)
    public function placeOrder(Request $request)
    {
        // Instead of saving immediately, redirect to customer info form
        return redirect()->route('order.customer');
    }

    // Show customer info form
    public function customerInfo()
    {
        return view('order.customer_info');
    }

    // Handle customer info submission and show confirmation
    public function confirmOrder(Request $request)
    {
        // Collect customer info
        $data = $request->only(['name', 'email', 'phone', 'address']);


        // Later you can save this to 'orders' table along with menu items
        return view('order.confirmation', compact('data'));
    }
    public function orderDetails()
{
    // Fetch all orders or mock data for now
    $orders = [
        ['id' => 1, 'customer' => 'Shahzaib', 'email' => 'example@mail.com', 'phone' => '0300‑1234567', 'status' => 'Pending'],
        ['id' => 2, 'customer' => 'Ali', 'email' => 'ali@mail.com', 'phone' => '0301‑9876543', 'status' => 'Completed'],
    ];

    return view('order.details', compact('orders'));
}

}
