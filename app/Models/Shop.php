<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'shop_name',
        'money',
        'day',
        'reputation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessLogs()
    {
        return $this->hasMany(BusinessLog::class);
    }
}
