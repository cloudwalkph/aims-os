<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(OauthClientsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectTypesTableSeeder::class);
        $this->call(AgenciesTableSeeder::class);
        $this->call(ManpowerTypesTableSeeder::class);
        $this->call(MealTypesTableSeeder::class);
        $this->call(VehicleTypesTableSeeder::class);
        $this->call(JobOrderTempSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(JobOrderClientsSeeder::class);
//        $this->call(AssignmentsTableSeeder::class);
        $this->call(ValidateQuestionsSeeder::class);
        $this->call(AnswersSeeder::class);
    }
}
