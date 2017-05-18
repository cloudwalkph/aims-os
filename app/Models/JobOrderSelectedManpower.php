<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderSelectedManpower extends Model
{
    use SoftDeletes;
    
    protected $table = 'job_order_selected_manpowers';
    protected $fillable = ['job_order_id', 'manpower_id','venue_id','buffer'];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function manpower()
    {
        return $this->belongsTo('App\Models\Manpower');
    }

    public function venue()
    {
    	return $this->belongsTo('App\Models\Venue');
    }
}
