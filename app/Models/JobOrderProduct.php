<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderProduct extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_products';
    protected $guarded = ['id'];

    public static $rules = [
        'job_order_id'      => 'required',
        'item_name'      	=> 'required',
        'expected_quantity' => 'required',
    ];

    public static $filterable = [
        'item_name',
        'expected_quantity',
    ];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    function deliveries()
    {
      return $this->hasMany('App\Models\InventoryDeliveries', 'product_id');
    }

    function releases()
    {
      return $this->hasMany('App\Models\InventoryReleases', 'product_id');
    }
}
