<?php

use Illuminate\Database\Seeder;
use App\Models\ValidateAnswers;

class AnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ValidateAnswers::create( [
            'id'=>1,
            'answers'=>'Within the given deadline',
            'questions_id'=>1,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>2,
            'answers'=>'late',
            'questions_id'=>1,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>3,
            'answers'=>'Yes',
            'questions_id'=>3,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>4,
            'answers'=>'No',
            'questions_id'=>3,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>5,
            'answers'=>'Upon the issuance of Job Order',
            'questions_id'=>4,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>6,
            'answers'=>'1-2 days after the issuance of JO',
            'questions_id'=>4,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>7,
            'answers'=>'Late advise',
            'questions_id'=>4,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>8,
            'answers'=>'Yes',
            'questions_id'=>5,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>9,
            'answers'=>'No',
            'questions_id'=>5,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>10,
            'answers'=>'Yes',
            'questions_id'=>6,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>11,
            'answers'=>'No',
            'questions_id'=>6,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>12,
            'answers'=>'Within the day (after receiving the JO)',
            'questions_id'=>8,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>13,
            'answers'=>'Days after alignment',
            'questions_id'=>8,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>14,
            'answers'=>'Always',
            'questions_id'=>9,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>15,
            'answers'=>'Sometimes',
            'questions_id'=>9,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>16,
            'answers'=>'Always',
            'questions_id'=>10,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>17,
            'answers'=>'Sometimes',
            'questions_id'=>10,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>18,
            'answers'=>'Always',
            'questions_id'=>11,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>19,
            'answers'=>'Sometimes',
            'questions_id'=>11,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>20,
            'answers'=>'Yes',
            'questions_id'=>12,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>21,
            'answers'=>'No',
            'questions_id'=>12,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>22,
            'answers'=>'Yes',
            'questions_id'=>13,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>23,
            'answers'=>'No',
            'questions_id'=>13,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>24,
            'answers'=>'Yes',
            'questions_id'=>14,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>25,
            'answers'=>'No',
            'questions_id'=>14,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>26,
            'answers'=>'Yes',
            'questions_id'=>16,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>27,
            'answers'=>'No',
            'questions_id'=>16,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>28,
            'answers'=>'Yes',
            'questions_id'=>17,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>29,
            'answers'=>'No',
            'questions_id'=>17,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>30,
            'answers'=>'Yes',
            'questions_id'=>18,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>31,
            'answers'=>'No',
            'questions_id'=>18,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>32,
            'answers'=>'Yes',
            'questions_id'=>19,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>33,
            'answers'=>'No',
            'questions_id'=>19,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>34,
            'answers'=>'Yes',
            'questions_id'=>20,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>35,
            'answers'=>'No',
            'questions_id'=>20,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>36,
            'answers'=>'Yes',
            'questions_id'=>21,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>37,
            'answers'=>'No',
            'questions_id'=>21,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>38,
            'answers'=>'Yes',
            'questions_id'=>22,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>39,
            'answers'=>'No',
            'questions_id'=>22,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>40,
            'answers'=>'Yes',
            'questions_id'=>23,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>41,
            'answers'=>'No',
            'questions_id'=>23,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>42,
            'answers'=>'Yes',
            'questions_id'=>24,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>43,
            'answers'=>'No',
            'questions_id'=>24,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>44,
            'answers'=>'Yes',
            'questions_id'=>25,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>45,
            'answers'=>'No',
            'questions_id'=>25,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>46,
            'answers'=>'Yes',
            'questions_id'=>26,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>47,
            'answers'=>'No',
            'questions_id'=>26,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>48,
            'answers'=>'Yes',
            'questions_id'=>27,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>49,
            'answers'=>'No',
            'questions_id'=>27,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>50,
            'answers'=>'Yes',
            'questions_id'=>28,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>51,
            'answers'=>'No',
            'questions_id'=>28,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>52,
            'answers'=>'Yes',
            'questions_id'=>29,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>53,
            'answers'=>'No',
            'questions_id'=>29,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>54,
            'answers'=>'Yes',
            'questions_id'=>30,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>55,
            'answers'=>'No',
            'questions_id'=>30,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>56,
            'answers'=>'Yes',
            'questions_id'=>31,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>57,
            'answers'=>'No',
            'questions_id'=>31,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>58,
            'answers'=>'Yes',
            'questions_id'=>32,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>59,
            'answers'=>'No',
            'questions_id'=>32,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>60,
            'answers'=>'2-3 days after the event',
            'questions_id'=>33,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>61,
            'answers'=>'Late',
            'questions_id'=>33,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>62,
            'answers'=>'Yes ',
            'questions_id'=>34,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>63,
            'answers'=>'No',
            'questions_id'=>34,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>64,
            'answers'=>'2-3 days after the completion',
            'questions_id'=>35,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>65,
            'answers'=>'Late',
            'questions_id'=>35,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>66,
            'answers'=>'Yes',
            'questions_id'=>36,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>67,
            'answers'=>'No',
            'questions_id'=>36,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>68,
            'answers'=>'Yes',
            'questions_id'=>37,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>69,
            'answers'=>'No',
            'questions_id'=>37,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>70,
            'answers'=>'Yes',
            'questions_id'=>46,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>71,
            'answers'=>'No',
            'questions_id'=>46,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>72,
            'answers'=>'During alignment meeting',
            'questions_id'=>47,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>73,
            'answers'=>'The same day of alignment meeting',
            'questions_id'=>47,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>74,
            'answers'=>'1-2 days after alignment meeting',
            'questions_id'=>47,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>75,
            'answers'=>'Yes',
            'questions_id'=>48,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>76,
            'answers'=>'No',
            'questions_id'=>48,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>77,
            'answers'=>'Upon submission',
            'questions_id'=>49,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>78,
            'answers'=>'2-3 days',
            'questions_id'=>49,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>79,
            'answers'=>'Within the day (after receiving the JO)',
            'questions_id'=>50,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>80,
            'answers'=>'Days after alignment',
            'questions_id'=>50,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>81,
            'answers'=>'Always',
            'questions_id'=>51,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>82,
            'answers'=>'Sometimes',
            'questions_id'=>51,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>83,
            'answers'=>'Yes',
            'questions_id'=>52,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>84,
            'answers'=>'No',
            'questions_id'=>52,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>85,
            'answers'=>'Yes',
            'questions_id'=>53,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>86,
            'answers'=>'No',
            'questions_id'=>53,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>87,
            'answers'=>'Yes',
            'questions_id'=>54,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>88,
            'answers'=>'No',
            'questions_id'=>54,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>89,
            'answers'=>'Yes',
            'questions_id'=>55,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>90,
            'answers'=>'No',
            'questions_id'=>55,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>91,
            'answers'=>'Yes',
            'questions_id'=>56,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>92,
            'answers'=>'No',
            'questions_id'=>56,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>93,
            'answers'=>'Yes',
            'questions_id'=>57,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>94,
            'answers'=>'No',
            'questions_id'=>57,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>95,
            'answers'=>'Yes',
            'questions_id'=>58,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>96,
            'answers'=>'No',
            'questions_id'=>58,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>97,
            'answers'=>'on target',
            'questions_id'=>59,
            'score'=>90,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>98,
            'answers'=>'below target',
            'questions_id'=>59,
            'score'=>10,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>99,
            'answers'=>'3 days before the cut-off',
            'questions_id'=>60,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>100,
            'answers'=>'2 days before the cut-off',
            'questions_id'=>60,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>101,
            'answers'=>'late',
            'questions_id'=>60,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>102,
            'answers'=>'on time',
            'questions_id'=>61,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>103,
            'answers'=>'late',
            'questions_id'=>61,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>104,
            'answers'=>'Yes',
            'questions_id'=>70,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>105,
            'answers'=>'No',
            'questions_id'=>70,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>106,
            'answers'=>'During alignment meeting',
            'questions_id'=>71,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>107,
            'answers'=>'The same day of alignment meeting',
            'questions_id'=>71,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>108,
            'answers'=>'1-2 days after alignment meeting',
            'questions_id'=>71,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>109,
            'answers'=>'Yes',
            'questions_id'=>72,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>110,
            'answers'=>'No',
            'questions_id'=>72,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>111,
            'answers'=>'Yes',
            'questions_id'=>73,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>112,
            'answers'=>'No',
            'questions_id'=>73,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>113,
            'answers'=>'Yes',
            'questions_id'=>74,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>114,
            'answers'=>'No',
            'questions_id'=>74,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>115,
            'answers'=>'Upon submission',
            'questions_id'=>75,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>116,
            'answers'=>'2-3 days',
            'questions_id'=>75,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>117,
            'answers'=>'Upon submission',
            'questions_id'=>76,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>118,
            'answers'=>'2-3 days',
            'questions_id'=>76,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>119,
            'answers'=>'Yes',
            'questions_id'=>77,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>120,
            'answers'=>'No',
            'questions_id'=>77,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>121,
            'answers'=>'Yes',
            'questions_id'=>78,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>122,
            'answers'=>'No',
            'questions_id'=>78,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>123,
            'answers'=>'Upon the issuance of Job Order',
            'questions_id'=>79,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>124,
            'answers'=>'1-2 days after the issuance of JO',
            'questions_id'=>79,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>125,
            'answers'=>'Late advise',
            'questions_id'=>79,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>126,
            'answers'=>'Always',
            'questions_id'=>80,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>127,
            'answers'=>'Sometimes',
            'questions_id'=>80,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>128,
            'answers'=>'Yes',
            'questions_id'=>81,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>129,
            'answers'=>'No',
            'questions_id'=>81,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>130,
            'answers'=>'Yes',
            'questions_id'=>82,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>131,
            'answers'=>'No',
            'questions_id'=>82,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>132,
            'answers'=>'Yes',
            'questions_id'=>83,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>133,
            'answers'=>'No',
            'questions_id'=>83,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>134,
            'answers'=>'before the event day',
            'questions_id'=>84,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>135,
            'answers'=>'late',
            'questions_id'=>84,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>136,
            'answers'=>'Yes',
            'questions_id'=>85,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>137,
            'answers'=>'No',
            'questions_id'=>85,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>138,
            'answers'=>'Always',
            'questions_id'=>86,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>139,
            'answers'=>'Sometimes',
            'questions_id'=>86,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>140,
            'answers'=>'Yes',
            'questions_id'=>87,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>141,
            'answers'=>'No',
            'questions_id'=>87,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>142,
            'answers'=>'Yes',
            'questions_id'=>88,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>143,
            'answers'=>'No',
            'questions_id'=>88,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>144,
            'answers'=>'Always',
            'questions_id'=>89,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>145,
            'answers'=>'Sometimes',
            'questions_id'=>89,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>146,
            'answers'=>'Yes',
            'questions_id'=>90,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>147,
            'answers'=>'No',
            'questions_id'=>90,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>148,
            'answers'=>'Yes',
            'questions_id'=>91,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>149,
            'answers'=>'No',
            'questions_id'=>91,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>150,
            'answers'=>'Yes',
            'questions_id'=>92,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>151,
            'answers'=>'No',
            'questions_id'=>92,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>152,
            'answers'=>'Yes',
            'questions_id'=>93,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>153,
            'answers'=>'No',
            'questions_id'=>93,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>154,
            'answers'=>'Yes',
            'questions_id'=>94,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>155,
            'answers'=>'No',
            'questions_id'=>94,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>156,
            'answers'=>'Yes',
            'questions_id'=>95,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>157,
            'answers'=>'No',
            'questions_id'=>95,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>158,
            'answers'=>'Yes',
            'questions_id'=>96,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>159,
            'answers'=>'No',
            'questions_id'=>96,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>160,
            'answers'=>'Yes',
            'questions_id'=>97,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>161,
            'answers'=>'No',
            'questions_id'=>97,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>162,
            'answers'=>'Yes',
            'questions_id'=>98,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>163,
            'answers'=>'No',
            'questions_id'=>98,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>164,
            'answers'=>'Yes',
            'questions_id'=>99,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>165,
            'answers'=>'No',
            'questions_id'=>99,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>166,
            'answers'=>'Yes',
            'questions_id'=>100,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>167,
            'answers'=>'No',
            'questions_id'=>100,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>168,
            'answers'=>'Yes',
            'questions_id'=>101,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>169,
            'answers'=>'No',
            'questions_id'=>101,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>170,
            'answers'=>'Yes',
            'questions_id'=>102,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>171,
            'answers'=>'No',
            'questions_id'=>102,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>172,
            'answers'=>'Yes',
            'questions_id'=>103,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>173,
            'answers'=>'No',
            'questions_id'=>103,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>174,
            'answers'=>'Yes',
            'questions_id'=>104,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>175,
            'answers'=>'No',
            'questions_id'=>104,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>176,
            'answers'=>'Yes',
            'questions_id'=>105,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>177,
            'answers'=>'No',
            'questions_id'=>105,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>178,
            'answers'=>'Excellent',
            'questions_id'=>106,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>179,
            'answers'=>'Good',
            'questions_id'=>106,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>180,
            'answers'=>'Fair',
            'questions_id'=>106,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>181,
            'answers'=>'Yes',
            'questions_id'=>107,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>182,
            'answers'=>'No',
            'questions_id'=>107,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>183,
            'answers'=>'Yes',
            'questions_id'=>108,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>184,
            'answers'=>'No',
            'questions_id'=>108,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>185,
            'answers'=>'Yes',
            'questions_id'=>109,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>186,
            'answers'=>'No',
            'questions_id'=>109,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>187,
            'answers'=>'Yes',
            'questions_id'=>110,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>188,
            'answers'=>'No',
            'questions_id'=>110,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>189,
            'answers'=>'Yes',
            'questions_id'=>111,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>190,
            'answers'=>'No',
            'questions_id'=>111,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>191,
            'answers'=>'Yes',
            'questions_id'=>112,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>192,
            'answers'=>'No',
            'questions_id'=>112,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>193,
            'answers'=>'Yes',
            'questions_id'=>113,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>194,
            'answers'=>'No',
            'questions_id'=>113,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>195,
            'answers'=>'Yes',
            'questions_id'=>114,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>196,
            'answers'=>'No',
            'questions_id'=>114,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>197,
            'answers'=>'Yes',
            'questions_id'=>115,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>198,
            'answers'=>'No',
            'questions_id'=>115,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>199,
            'answers'=>'Yes',
            'questions_id'=>116,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>200,
            'answers'=>'No',
            'questions_id'=>116,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>201,
            'answers'=>'3 days before the cut-off',
            'questions_id'=>118,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>202,
            'answers'=>'2 days before the cut-off',
            'questions_id'=>118,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>203,
            'answers'=>'late',
            'questions_id'=>118,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>204,
            'answers'=>'on time',
            'questions_id'=>119,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>205,
            'answers'=>'late',
            'questions_id'=>119,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>206,
            'answers'=>'Yes',
            'questions_id'=>128,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>207,
            'answers'=>'No',
            'questions_id'=>128,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>208,
            'answers'=>'During alignment meeting',
            'questions_id'=>129,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>209,
            'answers'=>'The same day of alignment meeting',
            'questions_id'=>129,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>210,
            'answers'=>'1-2 days after alignment meeting',
            'questions_id'=>129,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>211,
            'answers'=>'Yes',
            'questions_id'=>130,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>212,
            'answers'=>'No',
            'questions_id'=>130,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>213,
            'answers'=>'Upon submission',
            'questions_id'=>131,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>214,
            'answers'=>'2-3 days',
            'questions_id'=>131,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>215,
            'answers'=>'Within the day (after receiving the JO)',
            'questions_id'=>132,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>216,
            'answers'=>'Days after alignment',
            'questions_id'=>132,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>217,
            'answers'=>'Always',
            'questions_id'=>133,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>218,
            'answers'=>'Sometimes',
            'questions_id'=>133,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>219,
            'answers'=>'Yes',
            'questions_id'=>134,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>220,
            'answers'=>'No',
            'questions_id'=>134,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>221,
            'answers'=>'Yes',
            'questions_id'=>135,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>222,
            'answers'=>'No',
            'questions_id'=>135,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>223,
            'answers'=>'3 days before the cut-off',
            'questions_id'=>136,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>224,
            'answers'=>'2 days before the cut-off',
            'questions_id'=>136,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>225,
            'answers'=>'late',
            'questions_id'=>136,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>226,
            'answers'=>'Yes',
            'questions_id'=>137,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>227,
            'answers'=>'No',
            'questions_id'=>137,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>228,
            'answers'=>'Yes',
            'questions_id'=>138,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>229,
            'answers'=>'No',
            'questions_id'=>138,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>230,
            'answers'=>'3 days before the cut-off',
            'questions_id'=>139,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>231,
            'answers'=>'2 days before the cut-off',
            'questions_id'=>139,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>232,
            'answers'=>'late',
            'questions_id'=>139,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>233,
            'answers'=>'Yes',
            'questions_id'=>140,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>234,
            'answers'=>'No',
            'questions_id'=>140,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>235,
            'answers'=>'Yes',
            'questions_id'=>149,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>236,
            'answers'=>'No',
            'questions_id'=>149,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>237,
            'answers'=>'During alignment meeting',
            'questions_id'=>150,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>238,
            'answers'=>'The same day of alignment meeting',
            'questions_id'=>150,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>239,
            'answers'=>'1-2 days after alignment meeting',
            'questions_id'=>150,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>240,
            'answers'=>'Yes',
            'questions_id'=>151,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>241,
            'answers'=>'No',
            'questions_id'=>151,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>242,
            'answers'=>'Upon submission',
            'questions_id'=>152,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>243,
            'answers'=>'2-3 days',
            'questions_id'=>152,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>244,
            'answers'=>'Within the day (after receiving the JO)',
            'questions_id'=>153,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>245,
            'answers'=>'Days after alignment',
            'questions_id'=>153,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>246,
            'answers'=>'Always',
            'questions_id'=>154,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>247,
            'answers'=>'Sometimes',
            'questions_id'=>154,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>248,
            'answers'=>'Yes',
            'questions_id'=>155,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>249,
            'answers'=>'No',
            'questions_id'=>155,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>250,
            'answers'=>'Yes',
            'questions_id'=>156,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>251,
            'answers'=>'No',
            'questions_id'=>156,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>252,
            'answers'=>'Yes',
            'questions_id'=>157,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>253,
            'answers'=>'No',
            'questions_id'=>157,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>254,
            'answers'=>'Always',
            'questions_id'=>158,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>255,
            'answers'=>'Sometimes',
            'questions_id'=>158,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>256,
            'answers'=>'Yes',
            'questions_id'=>159,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>257,
            'answers'=>'No',
            'questions_id'=>159,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>258,
            'answers'=>'Yes',
            'questions_id'=>160,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>259,
            'answers'=>'No',
            'questions_id'=>160,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>260,
            'answers'=>'Yes',
            'questions_id'=>161,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>261,
            'answers'=>'No',
            'questions_id'=>161,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>262,
            'answers'=>'Yes',
            'questions_id'=>162,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>263,
            'answers'=>'No',
            'questions_id'=>162,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>264,
            'answers'=>'Yes',
            'questions_id'=>163,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>265,
            'answers'=>'No',
            'questions_id'=>163,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>266,
            'answers'=>'Excellent',
            'questions_id'=>164,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>267,
            'answers'=>'Good',
            'questions_id'=>164,
            'score'=>60,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>268,
            'answers'=>'Fair',
            'questions_id'=>164,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>269,
            'answers'=>'Yes',
            'questions_id'=>165,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>270,
            'answers'=>'No',
            'questions_id'=>165,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>271,
            'answers'=>'Yes',
            'questions_id'=>174,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>272,
            'answers'=>'No',
            'questions_id'=>174,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>273,
            'answers'=>'During alignment meeting',
            'questions_id'=>175,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>274,
            'answers'=>'The same day of alignment meeting',
            'questions_id'=>175,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>275,
            'answers'=>'1-2 days after alignment meeting',
            'questions_id'=>175,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>276,
            'answers'=>'Yes',
            'questions_id'=>176,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>277,
            'answers'=>'No',
            'questions_id'=>176,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>278,
            'answers'=>'Upon submission',
            'questions_id'=>177,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>279,
            'answers'=>'2-3 days',
            'questions_id'=>177,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>280,
            'answers'=>'Yes',
            'questions_id'=>178,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>281,
            'answers'=>'No',
            'questions_id'=>178,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>282,
            'answers'=>'Within the day (after receiving the JO)',
            'questions_id'=>179,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>283,
            'answers'=>'Days after alignment',
            'questions_id'=>179,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>284,
            'answers'=>'Always',
            'questions_id'=>180,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>285,
            'answers'=>'Sometimes',
            'questions_id'=>180,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>286,
            'answers'=>'Yes',
            'questions_id'=>181,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>287,
            'answers'=>'No',
            'questions_id'=>181,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>288,
            'answers'=>'Yes',
            'questions_id'=>182,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>289,
            'answers'=>'No',
            'questions_id'=>182,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>290,
            'answers'=>'Always',
            'questions_id'=>183,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>291,
            'answers'=>'Sometimes',
            'questions_id'=>183,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>292,
            'answers'=>'Yes',
            'questions_id'=>184,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>293,
            'answers'=>'No',
            'questions_id'=>184,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>294,
            'answers'=>'Yes',
            'questions_id'=>185,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>295,
            'answers'=>'No',
            'questions_id'=>185,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>296,
            'answers'=>'Yes',
            'questions_id'=>186,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>297,
            'answers'=>'No',
            'questions_id'=>186,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>298,
            'answers'=>'Yes',
            'questions_id'=>187,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>299,
            'answers'=>'No',
            'questions_id'=>187,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>300,
            'answers'=>'Yes',
            'questions_id'=>196,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>301,
            'answers'=>'No',
            'questions_id'=>196,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>302,
            'answers'=>'During alignment meeting',
            'questions_id'=>197,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>303,
            'answers'=>'The same day of alignment meeting',
            'questions_id'=>197,
            'score'=>40,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>304,
            'answers'=>'1-2 days after alignment meeting',
            'questions_id'=>197,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>305,
            'answers'=>'Yes',
            'questions_id'=>198,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>306,
            'answers'=>'No',
            'questions_id'=>198,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>307,
            'answers'=>'Upon submission',
            'questions_id'=>199,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>308,
            'answers'=>'2-3 days',
            'questions_id'=>199,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>309,
            'answers'=>'Always',
            'questions_id'=>200,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>310,
            'answers'=>'Sometimes',
            'questions_id'=>200,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>311,
            'answers'=>'Yes',
            'questions_id'=>201,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>312,
            'answers'=>'No',
            'questions_id'=>201,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>313,
            'answers'=>'Yes',
            'questions_id'=>202,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>314,
            'answers'=>'No',
            'questions_id'=>202,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>315,
            'answers'=>'before the event day',
            'questions_id'=>203,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>316,
            'answers'=>'late',
            'questions_id'=>203,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>317,
            'answers'=>'Within the day (after receiving the JO)',
            'questions_id'=>204,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>318,
            'answers'=>'Days after alignment',
            'questions_id'=>204,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>319,
            'answers'=>'Always',
            'questions_id'=>205,
            'score'=>80,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>320,
            'answers'=>'Sometimes',
            'questions_id'=>205,
            'score'=>20,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>321,
            'answers'=>'Yes',
            'questions_id'=>206,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>322,
            'answers'=>'No',
            'questions_id'=>206,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>323,
            'answers'=>'Yes',
            'questions_id'=>207,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>324,
            'answers'=>'No',
            'questions_id'=>207,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>325,
            'answers'=>'Yes',
            'questions_id'=>208,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>326,
            'answers'=>'No',
            'questions_id'=>208,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>327,
            'answers'=>'Yes',
            'questions_id'=>209,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>328,
            'answers'=>'No',
            'questions_id'=>209,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>329,
            'answers'=>'Yes',
            'questions_id'=>210,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>330,
            'answers'=>'No',
            'questions_id'=>210,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>331,
            'answers'=>'Yes',
            'questions_id'=>211,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>332,
            'answers'=>'No',
            'questions_id'=>211,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>333,
            'answers'=>'Yes',
            'questions_id'=>212,
            'score'=>100,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );



        ValidateAnswers::create( [
            'id'=>334,
            'answers'=>'No',
            'questions_id'=>212,
            'score'=>0,
            'created_at'=>NULL,
            'updated_at'=>NULL
        ] );


    }
}
