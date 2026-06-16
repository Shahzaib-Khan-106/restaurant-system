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
         // Store selected items temporarily or in session
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
        // Save customer info into orders table
        $order = Order::create($request->only([
            'name', 'email', 'phone', 'address', 'instructions'
        ]));

        // Save selected menu items (from the order form)
        foreach ($request->menu_items ?? [] as $itemId => $quantity) {
            if ($quantity > 0) {
                $item = MenuItem::find($itemId);
                OrderItem::create([
                    'order_id'     => $order->id,
                    'menu_item_id' => $itemId,
                    'quantity'     => $quantity,
                    'price'        => $item->price,
                ]);
            }
        }

        // Show confirmation page with saved order
        return view('order.confirmation', compact('order'));
    }

    // Show all placed orders with items
    public function orderDetails()
    {
        $orders = Order::with('items.menuItem')->get();
        return view('order.details', compact('orders'));
    }
}
