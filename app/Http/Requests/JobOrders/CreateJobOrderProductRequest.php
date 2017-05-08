<?php

namespace App\Http\Requests\JobOrders;

use App\Http\Requests\APIFormRequest;
use App\Models\JobOrderProduct;

class CreateJobOrderProductRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrderProduct::$rules;
    }
}
