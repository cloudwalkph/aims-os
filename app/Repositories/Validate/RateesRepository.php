<?php
namespace App\Repositories\Validate;

use App\Models\Assignment;
use App\Models\Department;
use App\Models\JobOrder;
use App\Models\ValidateQuestion;
use App\User;

class RateesRepository {
    public function getRatees($jobOrderId, $raterDepartmentId, $validateType)
    {
        $jobOrder = JobOrder::find($jobOrderId);
        if (! $jobOrder) {
            return null;
        }

        $questions = ValidateQuestion::select('ratee_department')->where('project_type', $jobOrder->project_type)
            ->where('validate_type', $validateType)
            ->where('rater_department', $raterDepartmentId)
            ->groupBy('ratee_department')
            ->get();

        $departmentIds = [];
        foreach ($questions as $question) {
            $departmentIds[] = $question['ratee_department'];
        }

        $departments = Department::whereIn('id', $departmentIds)
            ->get();

        // GET ratees
        $ratees = [];
        foreach ($departments as $department) {
            $assignments = Assignment::where('department_id', $department->id)
                ->where('job_order_id', $jobOrderId)
                ->get();

            foreach ($assignments as $assignment) {
                $user = User::with('profile', 'department')->where('id', $assignment->user_id)->first();
                if (! $user) {
                    continue;
                }

                $ratees[] = $user;
            }
        }

        return $ratees;
    }
}