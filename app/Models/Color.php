<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /* n:n */
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    /* n:n */
    public function sizes(){
        return $this->belongsToMany(Size::class);
    }
}
