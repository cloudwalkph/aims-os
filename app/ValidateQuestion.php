<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidateQuestion extends Model
{
    protected $table = 'validate_questions';
    protected $fillable = ['project_type', 'rater_department', 'ratee_department', 'question'];
}
