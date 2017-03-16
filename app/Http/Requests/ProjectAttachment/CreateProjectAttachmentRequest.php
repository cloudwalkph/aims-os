<?php

namespace App\Http\Requests\ProjectAttachment;

use App\Http\Requests\APIFormRequest;
use App\Models\JobOrderProjectAttachment;

class CreateProjectAttachmentRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return JobOrderProjectAttachment::$rules;
    }
}
