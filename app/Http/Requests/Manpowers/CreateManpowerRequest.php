<?php

namespace App\Http\Requests\Manpowers;

use App\Http\Requests\APIFormRequest;
use App\Models\JobOrderManpower;

class CreateManpowerRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrderManpower::$rules;
    }
}
