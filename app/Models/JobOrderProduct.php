<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderProduct extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_products';
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }
}
