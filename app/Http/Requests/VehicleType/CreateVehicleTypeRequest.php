<?php

namespace App\Http\Requests\VehicleType;

use App\Http\Requests\APIFormRequest;
use App\Models\VehicleType;

class CreateVehicleTypeRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return VehicleType::$rules;
    }
}
