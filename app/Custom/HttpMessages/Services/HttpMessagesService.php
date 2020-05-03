<?php

namespace App\Custom\HttpMessages\Services;

use Illuminate\Http\RedirectResponse;

class HttpMessagesService {

    public function __construct() {
    }

    /**
     * @return RedirectResponse
     */
    public function createResponseWithGenericError() {
        $errors = [__('validation.generic_error')];
        return redirect()->back()->withErrors($errors)->withInput();
    }

    /**
     * @param string $message
     * @param string $redirectRoute
     * @return RedirectResponse
     */
    public function createSuccessResponse($message, $redirectRoute = null) {
        if($redirectRoute == null) {
            return redirect()->back()->with('successMessage', $message);
        }
        else {
            return redirect()->route($redirectRoute)->with('successMessage', $message);
        }
    }

}
