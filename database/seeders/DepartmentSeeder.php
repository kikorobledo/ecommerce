<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::factory(8)->create()->each(function(Department $deparment){

            City::factory(8)->create([
                'department_id' => $deparment->id
            ])->each(function(City $city){

                District::factory(8)->create([
                    'city_id' => $city->id
                ]);

            });

        });
    }
}
