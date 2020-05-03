<?php

namespace App\Custom\Logging;

use Illuminate\Support\Facades\Log;

class AppLog {

    public static function info($message) {
        Log::info($message);
    }

    /**
     * @param $error \Exception
     */
    public static function error($error) {
        $message = $error;
        self::errorMessage($message);
    }

    /**
     * @param $message string
     */
    public static function errorMessage($message) {
        Log::error($message);
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
