<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use Softdeletes;

    protected $table = 'inventories';
    protected $guarded = ['id'];
}
