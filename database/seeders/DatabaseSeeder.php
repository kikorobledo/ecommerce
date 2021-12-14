<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SizeSeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ColorSizeSeeder;
use Database\Seeders\SubCategorySeeder;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\ColorProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Storage::deleteDirectory('products', 'public');
        Storage::deleteDirectory('categories', 'public');
        Storage::deleteDirectory('subcategories', 'public');

        Storage::makeDirectory('products', 'public');
        Storage::makeDirectory('categories', 'public');
        Storage::makeDirectory('subcategories', 'public');

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ColorProductSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ColorSizeSeeder::class);
        $this->call(DepartmentSeeder::class);
    }
}
