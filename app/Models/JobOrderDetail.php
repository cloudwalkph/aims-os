<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  JobOrderDetail extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_details';
    protected $guarded = ['id'];

    public function jo()
    {
        return $this->belongsTo(JobOrder::class, 'job_order_id', 'id');
    }
}
