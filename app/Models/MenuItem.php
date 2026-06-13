<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['restaurant_id', 'name', 'description', 'price', 'category'];

    // Relationship: Each menu item belongs to one restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
