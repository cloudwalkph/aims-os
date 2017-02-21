<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderManpower extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_manpowers';
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function manpowerType()
    {
        return $this->belongsTo('App\Models\ManpowerType');
    }
}
