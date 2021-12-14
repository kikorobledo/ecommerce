<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [

            [
                'category_id' => 1,
                'name' => 'Celulares y smart phones',
                'slug' => Str::slug('Celulares y smart phones'),
                'color' => true,
            ],

            [
                'category_id' => 1,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares'),
            ],

            [
                'category_id' => 1,
                'name' => 'Smart watch',
                'slug' => Str::slug('Smart watch'),
            ],

            [
                'category_id' => 2,
                'name' => 'Tv y audio',
                'slug' => Str::slug('Tv y audio'),
            ],

            [
                'category_id' => 2,
                'name' => 'Audios',
                'slug' => Str::slug('Audios'),
            ],

            [
                'category_id' => 2,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos'),
            ],

            [
                'category_id' => 3,
                'name' => 'X Box',
                'slug' => Str::slug('X Box'),
            ],

            [
                'category_id' => 3,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station'),
            ],

            [
                'category_id' => 3,
                'name' => 'Video juegos para PC',
                'slug' => Str::slug('Video juegos para PC'),
            ],

            [
                'category_id' => 3,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo'),
            ],

            [
                'category_id' => 4,
                'name' => 'Portatiles',
                'slug' => Str::slug('Portatiles'),
            ],

            [
                'category_id' => 4,
                'name' => 'PC Escritorio',
                'slug' => Str::slug('PC Escritorio'),
            ],

            [
                'category_id' => 4,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento'),
            ],

            [
                'category_id' => 4,
                'name' => 'Accesorio computadora',
                'slug' => Str::slug('Accesorio computadora'),
            ],

            [
                'category_id' => 5,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
            ],

            [
                'category_id' => 5,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],

            [
                'category_id' => 5,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
                'color' => true,
                'size' => true
            ],

            [
                'category_id' => 5,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
                'color' => true,
                'size' => true
            ],
        ];

        foreach($subcategories as $subcategory){

            Subcategory::create($subcategory);

        }
    }
}
