<?php

namespace App\Http\Requests\DepartmentInvolved;

use App\Http\Requests\APIFormRequest;
use App\Models\JobOrderDepartmentInvolved;

class CreateDepartmentInvolvedRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrderDepartmentInvolved::$rules;
    }
}
