<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /* 1:n */
    public function products(){
        return $this->hasMany(Product::class);
    }

    /* 1:n  inverse*/
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
