<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'location', 'phone'];

    // Relationship: One restaurant has many menu items
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
