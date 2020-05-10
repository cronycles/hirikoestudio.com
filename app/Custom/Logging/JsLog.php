<?php

namespace App\Custom\Logging;

use Illuminate\Support\Facades\Log;

class JsLog {

    public static function info($message) {
        Log::channel('js')->info($message);
    }

    /**
     * @param $error \Exception
     */
    public static function error($error) {
        $message = $error->getMessage();
        self::errorMessage($message);
    }

    /**
     * @param $message string
     */
    public static function errorMessage($message) {
        Log::channel('js')->error($message);
    }

    /**
     * @param $message string
     * @param $error \Exception
     */
    public static function errorMessageException($message, $error) {
        $errorMessage = $error->getMessage();
        $message = $message . "\n" . $errorMessage;
        self::errorMessage($message);
    }
}
