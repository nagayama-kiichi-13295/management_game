<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
    ];

    public function shop_skills()
    {
        return $this->hasMany(ShopSkill::class);
    }
}
