<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'rating', 'user_id', 'product_id'];

    /* 1:n */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /* 1:n */
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
