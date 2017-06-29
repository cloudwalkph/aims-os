<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValidateQuestion extends Model
{
    use SoftDeletes;

    protected $table = 'validate_questions';
    protected $fillable = ['project_type', 'rater_department', 'ratee_department', 'question'];

    public function choices()
    {
        return $this->hasMany(ValidateQuestionChoice::class);
    }
}
