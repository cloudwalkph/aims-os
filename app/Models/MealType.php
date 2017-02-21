<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MealType extends Model
{
    use SoftDeletes;

    protected $table = 'meal_types';
    protected $fillable = ['name', 'slug'];

    public function joMeal()
    {
        return $this->hasMany('App\Models\JobOrderMeal');
    }
}
