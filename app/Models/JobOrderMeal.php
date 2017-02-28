<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderMeal extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_meals';
    protected $guarded = ['id'];

    public static $rules = [
        'job_order_id'      => 'required',
        'meal_type_id'      => 'required',
        'quantity'          => 'required',
        'serving_time'      => 'required',
        'pickup_by'         => 'required',
        'remarks'           => 'required',
    ];

    public static $filterable = [
        'name',
        'pickup_by',
        'serving_time',
    ];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function mealType()
    {
        return $this->belongsTo('App\Models\MealType');
    }
}
