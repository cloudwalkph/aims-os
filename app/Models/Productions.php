<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productions extends Model
{
    use SoftDeletes;

    protected $table = 'productions';
    protected $guarded = ['id'];
}
