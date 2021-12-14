<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'icon'
    ];

    /* 1:n */
    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }

    /* n:n */
    public function brands(){
        return $this->belongsToMany(Brand::class);
    }

    /*  */
    public function products(){
        return $this->hasManyThrough(Product::class, SubCategory::class);
    }

    /* URL slug */
    public function getRouteKeyName(){
        return 'slug';
    }
}
