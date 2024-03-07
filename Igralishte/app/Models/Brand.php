<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(Brand_category::class, 'brand_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Brand_tag::class, 'brand_brand_tag');
    }

    public function images()
    {
        return $this->hasMany(Brand_image::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
