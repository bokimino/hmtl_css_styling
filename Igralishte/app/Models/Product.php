<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function discount()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function category()
    {
        return $this->belongsTo(Product_category::class, 'product_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Product_tag::class);
    }

    public function accessories()
    {
        return $this->belongsTo(Accessory::class);
    }

    public function images()
    {
        return $this->hasMany(Product_image::class);
    }

   
}
