<?php
namespace App\Repositories\Validate;

use App\Models\JobOrder;
use App\Models\ValidateQuestion;

class QuestionsRepository {
    public function getQuestions($raterDepartmentId, $rateeDepartmentId, $jobOrderId, $validateType)
    {
        $jobOrder = JobOrder::find($jobOrderId);

        if (! $jobOrder) {
            return null;
        }

        $questions = ValidateQuestion::with('choices')->where('project_type', $jobOrder->project_type)
            ->where('validate_type', $validateType)
            ->where('rater_department', $raterDepartmentId)
            ->where('ratee_department', $rateeDepartmentId)
            ->get();

        return $questions;
    }
}