<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColorProduct extends Model
{
    use HasFactory;

    protected $table = "color_product";

    /* 1:n  Inv */
    public function color(){
        return $this->belongsTo(Color::class);
    }

    /* 1:n  Inv */
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
