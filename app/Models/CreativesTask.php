<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreativesTask extends Model
{
    use SoftDeletes;

    protected $table = 'creatives_tasks';
    protected $guarded = ['id'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
