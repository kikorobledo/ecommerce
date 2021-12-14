<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /* n:n */
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    /* 1:n */
    public function productss(){
        return $this->hasMany(Product::class);
    }
}
