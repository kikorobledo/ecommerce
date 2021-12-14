<?php

namespace App\Models;

use App\Models\City;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cities(){
        return $this->hasMany(City::class);
    }

    /* 1:n */
    public function orders(){
        return $this->hasMany(Order::class);
    }


}
