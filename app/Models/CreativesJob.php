<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreativesJob extends Model
{
    use SoftDeletes;

    protected $table = 'creatives_jobs';
    protected $fillable = ['job_order_id', 'description', 'deadline'];

    public static $rules = [
        'job_order_id'     => 'required',
        'description'      => 'required',
        'deadline'         => 'required',
        'user_id'          => 'required',
    ];

    public static $filterable = [
        'deadline',
        'project_name',
        'job_order_no',
        'first_name',
        'last_name'
    ];

    public function jo()
    {
        return $this->belongsTo('App\Models\JobOrder', 'job_order_id', 'id');
    }

    public function assigned()
    {
        return $this->hasOne('App\Models\CreativesJobAssignedPerson');
    }
}
