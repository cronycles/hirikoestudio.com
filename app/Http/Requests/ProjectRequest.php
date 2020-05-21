<?php

namespace App\Http\Requests;

use App\Custom\Form\Requests\TranslatableFieldsRequest;

class ProjectRequest extends TranslatableFieldsRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getRulesByConfigurationFields('custom.form.project.fields');
    }
}
