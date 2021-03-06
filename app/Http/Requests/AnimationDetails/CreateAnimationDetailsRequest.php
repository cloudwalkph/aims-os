<?php

namespace App\Http\Requests\AnimationDetails;

use App\Http\Requests\APIFormRequest;
use App\Models\JobOrderAnimationDetail;

class CreateAnimationDetailsRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrderAnimationDetail::$rules;
    }
}
