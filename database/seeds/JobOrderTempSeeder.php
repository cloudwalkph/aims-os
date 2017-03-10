<?php

use Illuminate\Database\Seeder;
use App\Models\JobOrder;

class JobOrderTempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobOrder::create([
            'job_order_no'  => '58BD0B7D68C52',
            'user_id' => 7,
            'project_name'         => 'Quantum Physics',
            'project_types'      => '[{"name": "Activations"}, {"name": "Ambient"}]',
            'status'     => 'pending'
        ]);

        JobOrder::create([
            'job_order_no'  => '58BD0BC79E7F2',
            'user_id' => 7,
            'project_name'         => 'Gatsby',
            'project_types'      => '[{"name": "Sampling"}, {"name": "Logistics"}]',
            'status'     => 'pending'
        ]);
    }
}
