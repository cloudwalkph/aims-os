<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManpowerFile extends Model
{
    use SoftDeletes;

    protected $table = 'manpower_files';
    protected $fillable = ['manpower_id', 'url', 'type'];

    public function manpower()
    {
        return $this->belongsTo('App\Models\Manpower');
    }
}
