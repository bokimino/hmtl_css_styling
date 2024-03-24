<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Discount_category::class, 'discount_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
