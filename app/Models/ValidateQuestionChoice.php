<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValidateQuestionChoice extends Model
{
    use SoftDeletes;

    protected $table = 'validate_question_choices';
    protected $fillable = ['validate_question_id', 'choice', 'point'];

    public function question()
    {
        $this->belongsTo(ValidateQuestion::class);
    }
}
