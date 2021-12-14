<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Celulares y Tablets',
                'slug' => Str::slug('Celulares y Tablets'),
                'icon' => '<i class="fas fa-mobile-alt"></i>'
            ],

            [
                'name' => 'Tv, Audio y Video',
                'slug' => Str::slug('Tv, Audio y Video'),
                'icon' => '<i class="fas fa-tv"></i>'
            ],

            [
                'name' => 'Consolas y Video Juegos',
                'slug' => Str::slug('Consolas y Video Juegos'),
                'icon' => '<i class="fas fa-gamepad"></i>'
            ],

            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="fas fa-laptop-code"></i>'
            ],

            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fas fa-tshirt"></i>'
            ],

        ];

        foreach($categories as $category){

            $category = Category::factory(1)->create($category)->first();

            $brands = Brand::factory(4)->create();

            foreach($brands as $brand){

                $brand->categories()->attach($category->id);

            }

        }
    }
}
