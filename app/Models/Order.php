<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Mass assignable fields (only those present in your migration)
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'restaurant_id'
    ];

    // Relationships
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
