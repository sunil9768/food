<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'category_id', 'vendor_id', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
