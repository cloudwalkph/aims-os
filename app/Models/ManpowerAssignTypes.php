<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManpowerAssignTypes extends Model
{
    use SoftDeletes;

    protected $table = 'manpower_assign_types';
    protected $fillable = [
    	'manpower_id','manpower_type_id'
    ];

    public function manpower() {
    	 return $this->belongsTo('App\Models\Manpower');
    }

    public function manpowerType()
    {
        return $this->belongsTo('App\Models\ManpowerType');
    }
}
