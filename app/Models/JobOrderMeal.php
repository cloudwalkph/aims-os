<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderMeal extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_meals';
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function mealType()
    {
        return $this->belongsTo('App\Models\MealType');
    }
}
