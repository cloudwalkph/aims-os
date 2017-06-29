<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidateQuestionChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validate_question_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('validate_question_id')->unsigned();
            $table->enum('validate_type', ['pre', 'event-proper', 'post'])->default('pre');
            $table->string('choice');
            $table->double('point');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('validate_question_id')
                ->references('id')
                ->on('validate_questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validate_question_choices');
    }
}
