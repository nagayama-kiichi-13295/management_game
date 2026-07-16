<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'shop_id',
        'name',
        'price',
        'popularity',
        'developed',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
