<?php

namespace App\Models;

use App\Models\JobOrder;
use Illuminate\Database\Eloquent\Model;

class JobOrderProducts extends Model
{
    protected $table = 'job_order_products';
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }
}
