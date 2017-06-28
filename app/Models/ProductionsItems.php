<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionsItems extends Model
{
    use SoftDeletes;

    protected $table = 'production_items';
    protected $guarded = ['id'];
}
