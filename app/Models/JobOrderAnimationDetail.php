<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderAnimationDetail extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_animation_details';
    protected $guarded = ['id'];
}
