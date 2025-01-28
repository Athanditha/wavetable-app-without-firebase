<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'contact_name', 'contact_phone'
    ];

    public function equipment()
    {
        return $this->hasMany(Item::class);
    }
}
