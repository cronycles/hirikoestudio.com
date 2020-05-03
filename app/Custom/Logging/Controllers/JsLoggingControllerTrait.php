<?php

namespace App\Custom\Logging\Controllers;

use App\Custom\Logging\AppLog;
use Illuminate\Http\Request;

trait JsLoggingControllerTrait {

    public function __construct() {
    }

    public function logInfo(Request $request) {
        $message = 'JS info:' . json_encode($request->input());
        AppLog::info($message);
    }

    public function logError(Request $request) {
        $message = 'JS error:' . json_encode($request->input());
        AppLog::errorMessage($message);
    }

}
