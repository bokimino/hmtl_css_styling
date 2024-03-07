<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand_tag extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_brand_tag');
    }
}
