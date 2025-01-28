<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id', 'equipment_id', 'quantity', 'price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Item::class);
    }
}
