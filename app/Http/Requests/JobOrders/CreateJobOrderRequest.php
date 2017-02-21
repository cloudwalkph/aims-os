<?php

namespace App\Http\Requests\JobOrders;

use App\Http\Requests\APIFormRequest;
use App\Models\Event;
use App\Models\JobOrder;

class CreateJobOrderRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrder::$rules;
    }
}
