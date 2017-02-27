<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderDepartmentInvolved extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_department_involved';
    protected $guarded = ['id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }
}
