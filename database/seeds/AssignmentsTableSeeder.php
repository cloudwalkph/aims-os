<?php

use Illuminate\Database\Seeder;
use App\Models\Assignment;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 1,
            'department_id'  => 1,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 2,
            'department_id'  => 2,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 3,
            'department_id'  => 3,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 4,
            'department_id'  => 4,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 5,
            'department_id'  => 5,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 6,
            'department_id'  => 6,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 7,
            'department_id'  => 7,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 8,
            'department_id'  => 8,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 9,
            'department_id'  => 9,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 1,
            'user_id'  => 10,
            'department_id'  => 10,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 11,
            'department_id'  => 1,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 12,
            'department_id'  => 2,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 13,
            'department_id'  => 3,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 14,
            'department_id'  => 4,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 15,
            'department_id'  => 5,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 16,
            'department_id'  => 6,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 17,
            'department_id'  => 7,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 18,
            'department_id'  => 8,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 19,
            'department_id'  => 9,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
        Assignment::create([
            'job_order_id'  => 3,
            'user_id'  => 20,
            'department_id'  => 10,
            'deadline'  => date('Y-m-d'),
            'remarks'  => 'test',
        ]);
    }
}
