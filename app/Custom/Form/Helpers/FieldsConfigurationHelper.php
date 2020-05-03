<?php

namespace App\Custom\Form\Helpers;

use App\Custom\Logging\AppLog;

class FieldsConfigurationHelper {

    function __construct() {
    }

    /**
     * @param array $fieldConfiguration
     */
    public function getErrorTextFromConfiguration($fieldConfiguration) {
        try {
            $errorTextKeyString = __($fieldConfiguration['errorTextKey']);
            $errorTextKeyObj = json_decode($errorTextKeyString, true);
            $errorTextKey = $errorTextKeyObj['id'];
            $errorTextParams = $errorTextKeyObj['params'];
            return __($errorTextKey, $errorTextParams);

        } catch (\Exception $e) {
            AppLog::error($e);
            return 'Unknown field error';
        }
    }

    /**
     * @param array $fieldConfiguration
     */
    public function getValidationFromConfiguration($fieldConfiguration) {
        try {
            $validationArray = [];
            $validationConfigurationList = $fieldConfiguration['validations'] ?? [];
            if(!empty($validationConfigurationList)) {
                $sizeParamObject = $this->getSizeParamsFromConfigurationList($validationConfigurationList);

                if(!empty($validationConfigurationList)) {
                    $validationArray = $this->generateValidationArray($validationConfigurationList, $sizeParamObject);

                }
            }
            $outcome = $validationArray == null ? [] : $validationArray;
            return json_encode($outcome);

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }
    }

    /**
     * @param string[] $validationConfigurationList
     * @return FieldSizeParamObject
     */
    private function getSizeParamsFromConfigurationList($validationConfigurationList) {
        try {
            $outcome = null;
            if(!empty($validationConfigurationList)) {
                foreach ($validationConfigurationList as $validationConfiguration){
                    $validationConfigurationNameAndParamsString = explode(":", $validationConfiguration);
                    $validationNameString = $validationConfigurationNameAndParamsString[0];
                    $validationParamsString = count($validationConfigurationNameAndParamsString) > 1
                        ?  $validationConfigurationNameAndParamsString[1]
                        : null;

                    switch ($validationNameString) {
                        case 'same':
                            $outcome = new FieldSizeParamObject($validationParamsString, null, null);
                            break;
                        case 'min':
                            $outcome = new FieldSizeParamObject(null, $validationParamsString, null);
                            break;
                        case 'max':
                            $outcome = new FieldSizeParamObject(null, null, $validationParamsString);
                            break;
                        case 'between':
                            $validationParams = explode(",", $validationParamsString);
                            $outcome = new FieldSizeParamObject(null, $validationParams[0], $validationParams[1]);
                            break;
                        case 'date_equals':
                            $outcome = new FieldSizeParamObject();
                            $outcome->dateEquals = $validationParamsString;
                            break;
                        case 'after':
                            $outcome = new FieldSizeParamObject();
                            $outcome->after = $validationParamsString;
                            break;
                        case 'before':
                            $outcome = new FieldSizeParamObject();
                            $outcome->before = $validationParamsString;
                            break;
                    }
                }
            }
            if($outcome == null) {
                $outcome = new FieldSizeParamObject();
            }
            return $outcome;
        }catch (\Exception $e) {
            AppLog::error($e);
            return new FieldSizeParamObject();
        }
    }

    /**
     * @param string[] $validationConfigurationList
     * @param FieldSizeParamObject $sizeParamObject
     */
    private function generateValidationArray($validationConfigurationList, $sizeParamObject) {
        $outcome = [];
        foreach ($validationConfigurationList as $validationConfiguration) {

            $validationConfigurationNameAndParamsString = explode(":", $validationConfiguration);
            $validationNameString = $validationConfigurationNameAndParamsString[0];

            $validationObject = $this->generateBasicJavascriptValidation($validationNameString, $sizeParamObject);

            if($validationObject != null) {
                array_push($outcome, $validationObject);
            }
        }

        return $outcome;
    }

    /**
     * @param string $validationNameString
     * @param FieldSizeParamObject $sizeParamObject
     */
    private function generateBasicJavascriptValidation($validationNameString, $sizeParamObject) {
        try {
            $outcome = null;

            $requiredValidation = null;
            switch ($validationNameString) {
                case 'required':
                    $requiredValidation = [
                        'id' => config('custom.form.field-validations.REQUIRED'),
                        'params' => [$sizeParamObject->same, $sizeParamObject->min, $sizeParamObject->max]
                    ];
                    break;
                case 'numeric':
                    $requiredValidation = [
                        'id' => config('custom.form.field-validations.NUMBER'),
                        'params' => [$sizeParamObject->same, $sizeParamObject->min, $sizeParamObject->max]
                    ];
                    break;
                case 'alpha' :
                    $requiredValidation = [
                        'id' => config('custom.form.field-validations.ALPHA'),
                        'params' => [null, $sizeParamObject->same, $sizeParamObject->min, $sizeParamObject->max]
                    ];
                    break;
                case 'alpha_num':
                    $requiredValidation = [
                        'id' => config('custom.form.field-validations.ALPHA'),
                        'params' => [true, $sizeParamObject->same, $sizeParamObject->min, $sizeParamObject->max]
                    ];
                    break;
                case 'c_price':
                    $requiredValidation = [
                        'id' => config('custom.form.field-validations.PRICE'),
                        'params' => [$sizeParamObject->same, $sizeParamObject->min, $sizeParamObject->max]
                    ];
                    break;
                case 'date':
                    $requiredValidation = [
                        'id' => config('custom.form.field-validations.DATE'),
                        'params' => [$sizeParamObject->dateEquals, $sizeParamObject->after, $sizeParamObject->before]
                    ];
                    break;
                case 'email':
                    $requiredValidation = [
                        'id' => config('custom.form.field-validations.EMAIL'),
                        'params' => [$sizeParamObject->same]
                    ];
                    break;
            }

            return $requiredValidation;
        }catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

}
