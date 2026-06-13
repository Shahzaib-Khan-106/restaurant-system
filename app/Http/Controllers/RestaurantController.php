<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Notification;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        $restaurants = $query->paginate(10)->appends($request->query());

        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $restaurant = Restaurant::create($request->all());

        Notification::create([
            'type' => 'restaurant_created',
            'message' => 'New restaurant added: '.$restaurant->name,
        ]);

        return redirect()->route('restaurants.index')
                         ->with('success', '✅ Restaurant added successfully!');
    }

    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));
    }

    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $restaurant->update($request->all());

        Notification::create([
            'type' => 'restaurant_updated',
            'message' => 'Restaurant updated: '.$restaurant->name,
        ]);

        return redirect()->route('restaurants.index')
                         ->with('success', '✏️ Restaurant updated successfully!');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        Notification::create([
            'type' => 'restaurant_deleted',
            'message' => 'Restaurant deleted: '.$restaurant->name,
        ]);

        return redirect()->route('restaurants.index')
                         ->with('success', '🗑 Restaurant deleted successfully!');
    }
}
