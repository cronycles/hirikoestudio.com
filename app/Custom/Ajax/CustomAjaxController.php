<?php


namespace App\Custom\Ajax;


use App\Http\Controllers\Controller;

class CustomAjaxController extends Controller {

    /**
     * @param array|null $parameters
     * @param bool $hasErrors
     * @param array|null $errorList
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getResponseForAjaxCall(array $parameters = null, bool $hasErrors = false, array $errorList = null) {
        $response = [];
        if ($parameters != null || !empty($parameters)) {
            $response['params'] = $parameters;
        }
        if ($errorList != null || !empty($errorList)) {
            $response['errors'] = $errorList;
            $hasErrors = true;
        }
        $response['hasErrors'] = $hasErrors;
        return response()->json($response, 200);
    }

}
