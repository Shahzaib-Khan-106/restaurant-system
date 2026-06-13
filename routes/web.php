<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;

// Homepage: list all restaurants
Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');

// Restaurant CRUD
Route::resource('restaurants', RestaurantController::class);

// Menu Item CRUD (nested under restaurants)
Route::resource('restaurants.menu_items', MenuItemController::class)->shallow();

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
     ->name('admin.dashboard');

