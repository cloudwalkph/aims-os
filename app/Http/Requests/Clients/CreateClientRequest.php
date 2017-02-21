<?php

namespace App\Http\Requests\Events;

use App\Http\Requests\APIFormRequest;
use App\Models\Client;

class CreateClientRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Client::$rules;
    }
}
