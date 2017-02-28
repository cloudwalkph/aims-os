<?php

namespace App\Http\Requests\Meals;

use App\Http\Requests\APIFormRequest;
use App\Models\JobOrderMeal;

class CreateMealRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrderMeal::$rules;
    }
}
