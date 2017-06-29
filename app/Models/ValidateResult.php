<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValidateResult extends Model
{
    use SoftDeletes;

    protected $table = 'validate_results';
    protected $fillable = ['job_order_id', 'validate_question_id',
        'validate_question_choice_id', 'validate_date', 'validate_type', 'point'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function question()
    {
        return $this->belongsTo(ValidateQuestion::class);
    }

    public function choice()
    {
        return $this->belongsTo(ValidateQuestionChoice::class);
    }
}
