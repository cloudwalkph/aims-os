<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $table = 'inventories';
    protected $guarded = ['id'];

    // public static $rules = [
    //     'job_order_id'      => 'required',
    //     'item_name'      	=> 'required',
    //     'expected_quantity' => 'required',
    // ];

    // public static $filterable = [
    //     'item_name',
    //     'expected_quantity',
    // ];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }
}
