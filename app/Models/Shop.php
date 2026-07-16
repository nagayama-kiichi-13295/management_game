<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShopSkill;

class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'shop_name',
        'money',
        'day',
        'reputation',
        'kitchen_upgrade',
        'table_upgrade',
        'interior_upgrade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessLogs()
    {
        return $this->hasMany(BusinessLog::class);
    }

    public function shopSkills()
    {
        return $this->hasMany(ShopSkill::class);
    }
}
