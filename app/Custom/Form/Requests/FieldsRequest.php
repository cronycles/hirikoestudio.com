<?php

namespace App\Custom\Form\Requests;

use App\Custom\Form\Requests\Rules\Price;
use Illuminate\Foundation\Http\FormRequest;

abstract class FieldsRequest extends FormRequest
{

    /**
     * @param string $configurationKey
     * @return array
     */
    public function getRulesByConfigurationFields($configurationKey) {
        $outcome = [];

        $fieldsArray = config($configurationKey);

        foreach ($fieldsArray as $field) {
            $outcome[$field['name']] = $this->processValidations($field['validations']);
        }

        return $outcome;
    }

    /**
     * @param $configurationKey
     * @return array
     */
    protected function processValidations($validations) {
        $outcome = [];
        if($validations != null && !empty($validations)) {
            foreach ($validations as $validation) {
                if($validation == 'c_price') {
                    $validation = new Price;
                }
                array_push($outcome, $validation);
            }
        }


        return $outcome;
    }


}
