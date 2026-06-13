<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\Notification;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $query = $restaurant->menuItems();

        if ($request->filled('category')) {
            $query->where('category', 'like', "%{$request->input('category')}%");
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('sort')) {
            $query->orderBy($request->input('sort'), $request->input('direction', 'asc'));
        }

        $menuItems = $query->paginate(10)->appends($request->query());

        return view('menu_items.index', compact('menuItems', 'restaurant'));
    }

    public function create($restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        return view('menu_items.create', compact('restaurant'));
    }

    public function store(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'nullable|string|max:255',
        ]);

        $menuItem = $restaurant->menuItems()->create($request->all());

        Notification::create([
            'type' => 'menu_item_created',
            'message' => 'New menu item added: '.$menuItem->name,
        ]);

        return redirect()->route('restaurants.menu_items.index', $restaurant->id)
                         ->with('success', '✅ Menu item added successfully!');
    }

    public function show($menuItem_id)
    {
        $menuItem = MenuItem::findOrFail($menuItem_id);
        $restaurant = $menuItem->restaurant;

        return view('menu_items.show', compact('restaurant', 'menuItem'));
    }

    public function edit($menuItem_id)
    {
        $menuItem = MenuItem::findOrFail($menuItem_id);
        $restaurant = $menuItem->restaurant;

        return view('menu_items.edit', compact('restaurant', 'menuItem'));
    }

    public function update(Request $request, $menuItem_id)
    {
        $menuItem = MenuItem::findOrFail($menuItem_id);
        $restaurant = $menuItem->restaurant;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'nullable|string|max:255',
        ]);

        $menuItem->update($request->all());

        Notification::create([
            'type' => 'menu_item_updated',
            'message' => 'Menu item updated: '.$menuItem->name,
        ]);

        return redirect()->route('restaurants.menu_items.index', $restaurant->id)
                         ->with('success', '✏️ Menu item updated successfully!');
    }

    public function destroy($menuItem_id)
    {
        $menuItem = MenuItem::findOrFail($menuItem_id);
        $restaurant = $menuItem->restaurant;

        $menuItem->delete();

        Notification::create([
            'type' => 'menu_item_deleted',
            'message' => 'Menu item deleted: '.$menuItem->name,
        ]);

        return redirect()->route('restaurants.menu_items.index', $restaurant->id)
                         ->with('success', '🗑 Menu item deleted successfully!');
    }
}
