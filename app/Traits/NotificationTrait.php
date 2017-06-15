<?php
namespace App\Traits;

use App\Models\JobOrder;
use App\Models\JobOrderDepartmentInvolved;
use App\Notifications\JobOrderUpdated;
use App\Notifications\NewJobOrderAssignment;
use App\User;

trait NotificationTrait {
    private function newAssignedJobOrder($joId, $departmentId)
    {
        $jo = JobOrder::where('id', $joId)->first();

        if (! $jo) {
            return;
        }

        $users = User::where('department_id', $departmentId)
            ->get();

        if ($users->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $user->notify(new NewJobOrderAssignment($jo));
        }
    }
    private function jobOrderUpdated($joId, $initiator)
    {
        $jo = JobOrder::where('id', $joId)->first();

        if (! $jo) {
            return;
        }

        $departments = JobOrderDepartmentInvolved::where('job_order_id', $jo->id)->get();

        foreach ($departments as $department) {
            $users = User::where('department_id', $department->department_id)
                ->get();

            if ($users->isEmpty()) {
                continue;
            }

            foreach ($users as $user) {
                $user->notify(new JobOrderUpdated($jo, $initiator));
            }
        }
    }
}