<?php

use Illuminate\Database\Seeder;

class ProjectTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProjectType::create([
            'name'  => 'Activations'
        ]);

        \App\Models\ProjectType::create([
            'name'  => 'Ambient'
        ]);

        \App\Models\ProjectType::create([
            'name'  => 'Cash Advance'
        ]);

        \App\Models\ProjectType::create([
            'name'  => 'Concept'
        ]);

        \App\Models\ProjectType::create([
            'name'  => 'Events'
        ]);

        \App\Models\ProjectType::create([
            'name'  => 'Logistics'
        ]);

        \App\Models\ProjectType::create([
            'name'  => 'Sampling'
        ]);

        \App\Models\ProjectType::create([
            'name'  => 'Tie-ups'
        ]);
    }
}
