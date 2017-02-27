<?php

namespace App\Http\Requests\Venues;

use App\Http\Requests\APIFormRequest;
use App\Models\Venue;

class CreateVenuesRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Venue::$rules;
    }
}
