<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessLog extends Model
{
    protected $fillable = [
        'shop_id',
        'day',
        'customers',
        'sales',
        'expense',
        'profit',
        'weather',
        'event',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
