<?php

namespace App\Http\Requests\Users;


use App\Http\Requests\APIFormRequest;

class CreateUserRequest extends APIFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'             => 'required|email',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'department_id'     => 'required|exists:departments,id',
            'user_role_id'      => 'required|exists:user_roles,id'
        ];
    }
}
