<?php

namespace App\Http\Requests\Users;


use App\Http\Requests\APIFormRequest;

class ChangePasswordRequest extends APIFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required',
            'new_password'     => 'required',
            'verify_password'  => 'required'
        ];
    }
}
