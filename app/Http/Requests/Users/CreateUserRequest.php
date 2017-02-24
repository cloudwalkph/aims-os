<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\APIFormRequest;
use App\User;

class CreateUserRequest extends APIFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return User::$rules;
    }
}
