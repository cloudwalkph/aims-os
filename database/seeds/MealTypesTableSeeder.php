<?php

use Illuminate\Database\Seeder;
use App\Models\MealType;

class MealTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MealType::create([
            'slug'  => 'breakfast',
            'name'  => 'Breakfast'
        ]);

        MealType::create([
            'slug'  => 'lunch',
            'name'  => 'Lunch'
        ]);

        MealType::create([
            'slug'  => 'dinner',
            'name'  => 'Dinner'
        ]);
    }
}
