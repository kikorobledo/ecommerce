<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'imagiable_id',
        'imagiable_type'
    ];

    public function imagiable(){
        return $this->morphTo();
    }
}
