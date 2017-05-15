<?php

use Illuminate\Database\Seeder;
use App\Models\ValidateQuestions;
use App\Models\ValidateAnswers;

class CreativesQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        ValidateQuestions::create( [
            'id'=>213,
            'qname'=>'How would you describe the design style?',
            'qrater'=>7,
            'qdept'=>2,
            'qcat'=>'pre',
            'qtype'=>'S',
            'qsub'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'deleted_at'=>NULL
        ] );

        ValidateQuestions::create( [
            'id'=>214,
            'qname'=>'What do you think of the marketing/creative materials?',
            'qrater'=>7,
            'qdept'=>2,
            'qcat'=>'pre',
            'qtype'=>'S',
            'qsub'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'deleted_at'=>NULL
        ] );

        ValidateQuestions::create( [
            'id'=>215,
            'qname'=>'Does he/she make content more appealing?',
            'qrater'=>7,
            'qdept'=>2,
            'qcat'=>'pre',
            'qtype'=>'S',
            'qsub'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'deleted_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>335,
            'answers'=>'Very appreciated',
            'questions_id'=>213,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>336,
            'answers'=>'Appreciated',
            'questions_id'=>213,
            'score'=>50,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>337,
            'answers'=>'Lacking',
            'questions_id'=>213,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>338,
            'answers'=>'Well done',
            'questions_id'=>214,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>339,
            'answers'=>'Fair',
            'questions_id'=>214,
            'score'=>50,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>340,
            'answers'=>'Needs improvement',
            'questions_id'=>214,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>341,
            'answers'=>'Yes',
            'questions_id'=>215,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );

        ValidateAnswers::create( [
            'id'=>342,
            'answers'=>'No',
            'questions_id'=>215,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );
    }
}
