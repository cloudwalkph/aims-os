<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreativesJobAssignedPerson extends Model
{
    use SoftDeletes;

    protected $table = 'creatives_job_assigned_people';
    protected $fillable = ['creatives_create_job_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function creativesJob()
    {
        return $this->belongsTo('App\Models\CreativesJob');
    }
}
