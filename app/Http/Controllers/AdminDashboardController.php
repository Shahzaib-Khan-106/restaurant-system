<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\MenuItem;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalRestaurants = Restaurant::count();
        $totalMenuItems   = MenuItem::count();

        // Most popular categories (top 5)
        $popularCategories = MenuItem::select('category', DB::raw('COUNT(*) as count'))
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Recent changes (last 5 menu items added/updated)
        $recentMenuItems = MenuItem::latest()->take(5)->get();

        // Latest notifications (last 10)
        $notifications = Notification::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalRestaurants',
            'totalMenuItems',
            'popularCategories',
            'recentMenuItems',
            'notifications'
        ));
    }
}
