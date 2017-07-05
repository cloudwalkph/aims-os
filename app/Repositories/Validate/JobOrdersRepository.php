<?php
namespace App\Repositories\Validate;

use App\Models\Assignment;
use App\Models\JobOrder;
use App\Models\JobOrderSchedule;
use App\User;
use Carbon\Carbon;

class JobOrdersRepository {
    public function getAccountsJobOrders(User $user)
    {
        $jobOrders = JobOrder::where('user_id', $user->id)
            ->get();

        return $this->parseJobOrder($jobOrders);
    }

    public function getJobOrders(User $user)
    {
        // Get assignments
        $assignments = Assignment::where('user_id', $user->id)
            ->get();

        $jos = [];
        foreach ($assignments as $assignment) {
            $jos[] = $assignment->job_order_id;
        }

        // Get Job Orders
        $jobOrders = JobOrder::whereIn('id', $jos)
            ->get();

        // Parse and return job orders
        return $this->parseJobOrder($jobOrders);
    }

    private function parseJobOrder($jobOrders)
    {
        $result = [];
        foreach ($jobOrders as $key => $jobOrder) {
            $schedules = JobOrderSchedule::where('job_order_id', $jobOrder->id)
                ->orderBy('jo_datetime', 'ASC')
                ->get();



            // If there is no schedule set yet
            if ($schedules->isEmpty()) {
                $preEvent = 'inactive';
                $postEvent = 'inactive';
                $eventProper = 'inactive';

                // Store into the return array
                $jobOrder['start_date'] = null;
                $jobOrder['end_date'] = null;
                $jobOrder['pre_event'] = $preEvent;
                $jobOrder['post_event'] = $postEvent;
                $jobOrder['event_proper'] = $eventProper;

                $result[] = $jobOrder;

                continue;
            }

            $jobOrder['start_date'] = Carbon::createFromTimestamp(strtotime($schedules[0]->jo_datetime))->toDateString();
            $jobOrder['end_date'] = Carbon::createFromTimestamp(strtotime($schedules[$schedules->count() - 1]->jo_datetime))->toDateString();

            // Check if the post event is already done, don't include anymore
            $postEvent = Carbon::createFromTimestamp(strtotime($schedules[$schedules->count() - 1]->jo_datetime))->addDays(2);
            if ($postEvent->isPast()) {
                continue;
            }

            $preEvent = Carbon::createFromTimestamp(strtotime($schedules[0]->jo_datetime))->subDays(2);

            $preEvent = $preEvent->isFuture() ? 'active' : 'inactive';
            $postEvent = $postEvent->isFuture() ? 'active' : 'inactive';

            $eventProper = [];
            foreach ($schedules as $schedule) {
                $day = Carbon::createFromTimestamp(strtotime($schedule->jo_datetime));
                if ($day->isToday() || $day->isFuture()) {
                    $eventProper = 'active';
                    break;
                }

                $eventProper = 'inactive';
            }

            // Store into the return array
            $jobOrder['pre_event'] = $preEvent;
            $jobOrder['post_event'] = $postEvent;
            $jobOrder['event_proper'] = $eventProper;

            $result[] = $jobOrder;
        }

        return $result;
    }
}