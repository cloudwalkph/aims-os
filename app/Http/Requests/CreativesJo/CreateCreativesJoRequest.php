<?php

namespace App\Http\Requests\CreativesJo;

use App\Http\Requests\APIFormRequest;
use App\Models\CreativesJob;

class CreateCreativesJoRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return CreativesJob::$rules;
    }
}
