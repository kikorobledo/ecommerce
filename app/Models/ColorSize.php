<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColorSize extends Model
{
    use HasFactory;

    protected $table = "color_size";

    /* 1:n  Inv */
    public function color(){
        return $this->belongsTo(Color::class);
    }

    /* 1:n  Inv */
    public function size(){
        return $this->belongsTo(Size::class);
    }
}
