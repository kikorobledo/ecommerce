<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id'];

    /* 1:n inversa */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /* n:n */
    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');;
    }
}
