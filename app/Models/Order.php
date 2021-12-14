<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\District;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    const PENDIENTE = 1;
    const RECIBIDO = 2;
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULADO = 5;

    /* 1:n inv */
    public function department(){
        return $this->belongsTo(Department::class);
    }

    /* 1:n inv */
    public function city(){
       return  $this->belongsTo(City::class);
    }

    /* 1:n inv */
    public function district(){
        return $this->belongsTo(District::class);
    }

    /* 1:n inv */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
