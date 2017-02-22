<?php
namespace App\Traits;

use App\Models\JobOrder;

trait JobOrderTrait {
    public function getJobOrderIdByNumber($jobOrderNumber)
    {
        return JobOrder::where('job_order_no', $jobOrderNumber)->first();
    }
}