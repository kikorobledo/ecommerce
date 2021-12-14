<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(250)->create()->each(function (Product $product){

            Image::factory(4)->create([
                'imagiable_id' => $product->id,
                'imagiable_type' => Product::class
            ]);
        });
    }
}
