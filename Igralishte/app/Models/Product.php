<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
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
        return $this->belongsToMany(Product_tag::class, 'product_product_tag');
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
