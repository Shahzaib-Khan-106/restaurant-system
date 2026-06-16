<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;

// Homepage: list all restaurants
Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');

// Restaurant CRUD
Route::resource('restaurants', RestaurantController::class);

// Menu Item CRUD (nested under restaurants)
Route::resource('restaurants.menu_items', MenuItemController::class)->shallow();

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
     ->name('admin.dashboard');

// Customer order routes
Route::get('/order', [OrderController::class, 'showMenu'])->name('order.menu');
Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.place');
