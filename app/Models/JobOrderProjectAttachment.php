<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderProjectAttachment extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_project_attachments';
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }
}
