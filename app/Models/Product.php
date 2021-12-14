<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /* Accesores */
    public function getStockAttribute(){

        if($this->subcategory->size){

            return  ColorSize::whereHas('size.product', function(Builder $query){
                $query->where('id', $this->id);
            })->sum('quantity');

        }elseif($this->subcategory->color){

            return ColorProduct::whereHas('product', function(Builder $query){

                $query->where('id', $this->id);

            })->sum('quantity');

        }else{

            return $this->quantity;

        }
    }

    /* 1:n inverse */
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    /* 1:n inverse */
    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    /* n:n */
    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }

    /* 1:n */
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    /* 1:n polimorph */
    public function images(){
        return $this->morphMany(Image::class, 'imagiable');
    }

    /* URL slug */
    public function getRouteKeyName(){
        return 'slug';
    }

    /* n:n */
    public function users(){
        return $this->belongsToMany(User::class);
    }

    /* 1:n */
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
