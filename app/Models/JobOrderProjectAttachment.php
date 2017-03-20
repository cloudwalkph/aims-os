<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderProjectAttachment extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_project_attachments';
    protected $guarded = ['id'];

    public static $rules = [
        'job_order_id'   => 'required',
        'reference_for'  => 'required',
    ];

    public static $filterable = [
        'reference_for',
        'file_name',
    ];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }
}
