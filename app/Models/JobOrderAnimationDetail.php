<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderAnimationDetail extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_animation_details';
    protected $guarded = ['id'];

    public static $rules = [
        'job_order_id'      => 'required',
        'particular'        => 'required',
        'target_activity'   => 'required',
        'target_duration'   => 'required',
        'target_areas'      => 'required',
        'target_selling'    => 'required',
        'target_flyering'   => 'required',
        'target_survey'     => 'required',
        'target_experiment' => 'required',
        'target_others'     => 'required',
    ];

    public static $filterable = [
        'particular',
        'target_activity',
    ];
}
