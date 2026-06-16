<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;

class OrderController extends Controller
{
    // Show all menu items for ordering
    public function showMenu()
    {
        $menuItems = MenuItem::all();
        return view('order.menu', compact('menuItems'));
    }

    // Handle order submission (redirect to customer info screen)
    public function placeOrder(Request $request)
    {
        // Store selected items temporarily in session
        session(['menu_items' => $request->menu_items]);

        // Redirect to customer info form
        return redirect()->route('order.customer');
    }

    // Show customer info form
    public function customerInfo()
    {
        return view('order.customer_info');
    }

    // Handle customer info submission and save order
    public function confirmOrder(Request $request)
    {
        // Validate customer info
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'address' => 'required|string',
        ]);

        // Save customer info into orders table
        $order = Order::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'instructions'=> $request->instructions ?? null,
            'status'      => 'Pending',
        ]);

        // Retrieve menu items from session
        $menuItems = session('menu_items', []);

        // Save selected menu items safely
        foreach ($menuItems as $itemId => $quantity) {
            if ($quantity > 0) {
                $item = MenuItem::find($itemId);

                if ($item) {
                    OrderItem::create([
                        'order_id'     => $order->id,
                        'menu_item_id' => $itemId,
                        'quantity'     => $quantity,
                        'price'        => $item->price,
                    ]);
                } else {
                    // Log the issue instead of crashing
                    \Log::error("MenuItem not found for ID: " . $itemId);
                }
            }
        }

        // Clear session after saving
        session()->forget('menu_items');

        // Show confirmation page
        return view('order.confirmation', compact('order'));
    }

    // Show all placed orders with items
    public function orderDetails()
    {
        $orders = Order::with('items.menuItem')->get();
        return view('order.details', compact('orders'));
    }
}
