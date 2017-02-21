<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $productions = User::create([
            'user_role_id'  => 1,
            'department_id' => 1,
            'email'         => 'productions@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $productions->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);


        $creatives = User::create([
            'user_role_id'  => 1,
            'department_id' => 2,
            'email'         => 'creatives@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $creatives->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);


        $cmtuva = User::create([
            'user_role_id'  => 1,
            'department_id' => 3,
            'email'         => 'cmtuva@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $cmtuva->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);


        $hr = User::create([
            'user_role_id'  => 1,
            'department_id' => 4,
            'email'         => 'hr@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $hr->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);

        $inventory = User::create([
            'user_role_id'  => 1,
            'department_id' => 5,
            'email'         => 'inventory@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $inventory->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);

        $admin = User::create([
            'user_role_id'  => 1,
            'department_id' => 6,
            'email'         => 'admin@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $admin->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);

        $ae = User::create([
            'user_role_id'  => 1,
            'department_id' => 7,
            'email'         => 'ae@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $ae->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);

        $accounting = User::create([
            'user_role_id'  => 1,
            'department_id' => 8,
            'email'         => 'accounting@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $accounting->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);

        $setup = User::create([
            'user_role_id'  => 1,
            'department_id' => 9,
            'email'         => 'setup@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $setup->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);

        $operations = User::create([
            'user_role_id'  => 1,
            'department_id' => 10,
            'email'         => 'operations@activations.com',
            'password'      => Hash::make('password'),
        ]);

        $operations->profile()->create([
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'birthdate'     => $faker->date(),
            'street'        => $faker->streetAddress,
            'barangay'      => $faker->streetName,
            'city'          => $faker->city,
            'province'      => $faker->city,
            'status'        => 'active',
            'date_hired'    => $faker->date()
        ]);


    }
}
