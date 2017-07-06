<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionSuppliers extends Model
{
    use SoftDeletes;

    protected $table = 'production_suppliers';
    protected $guarded = ['id'];
}
