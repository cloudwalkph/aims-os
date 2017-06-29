<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productions extends Model
{
    protected $table = 'productions';
    protected $guarded = ['id'];
}
