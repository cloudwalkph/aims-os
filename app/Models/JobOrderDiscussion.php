<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrderDiscussion extends Model
{
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }
}
