<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email', 
        'customer_phone',
        'customer_address',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'notes'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getItemsCountAttribute()
    {
        return $this->orderItems()->count();
    }
}
