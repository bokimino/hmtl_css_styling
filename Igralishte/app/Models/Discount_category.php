<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount_category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
