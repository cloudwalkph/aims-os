<?php

namespace App\Http\Requests\Agencies;

use App\Http\Requests\APIFormRequest;
use App\Models\Agency;

class CreateAgencyRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Agency::$rules;
    }
}
