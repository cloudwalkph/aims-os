<?php

namespace App\Http\Requests\ManpowerType;

use App\Http\Requests\APIFormRequest;
use App\Models\ManpowerType;

class CreateManpowerTypeRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ManpowerType::$rules;
    }
}
