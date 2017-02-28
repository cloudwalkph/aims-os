<?php

namespace App\Http\Requests\Vehicles;

use App\Http\Requests\APIFormRequest;
use App\Models\JobOrderVehicle;

class CreateVehicleRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrderVehicle::$rules;
    }
}
