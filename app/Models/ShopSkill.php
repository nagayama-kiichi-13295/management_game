<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopSkill extends Model
{
    protected $fillable = [
        'shop_id',
        'skill_id',
        'level',
        'exp',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
