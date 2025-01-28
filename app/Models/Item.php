<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
 use HasFactory;
 
 protected $table = 'items';

 protected $fillable = [
    'brand',
    'name',
    'category',
    'description',
    'quantity',
    'sale_price',
    'rental_rate',
    'image'
];

public function category()
    {
        return $this->belongsTo(EquipmentCategory::class, 'category');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class)->withPivot('item_amt');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class)->withPivot('item_amt');
    }
    
}
