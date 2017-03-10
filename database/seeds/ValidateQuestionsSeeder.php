<?php

use Illuminate\Database\Seeder;
use App\Models\ValidateQuestions;

class ValidateQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ValidateQuestions::rawQ('ALTER TABLE `users` MODIFY `age` DATETIME');
    }
}
