<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function categories()
    {
        return $this->belongsToMany(Brand_category::class);
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
