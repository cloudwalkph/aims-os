<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderDepartmentInvolved extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_department_involved';
    protected $guarded = ['id'];

    public static $rules = [
        'job_order_id'     => 'required',
        'department_id'    => 'required',
        'deliverables'     => 'required',
        'deadline'         => 'required',
    ];

    public static $filterable = [
        'name',
        'deliverables',
        'deadline',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }
}
