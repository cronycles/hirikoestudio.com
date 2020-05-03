<?php

namespace App\Custom\Logging\Services;

use Illuminate\Support\Facades\Log;

class JsLoggingService {

    public function info($message) {
        Log::channel('js')->info($message);
    }

    /**
     * @param $error \Exception
     */
    public function error($error) {
        $message = $error->getMessage();
        $this->errorMessage($message);
    }

    /**
     * @param $message string
     */
    public function errorMessage($message) {
        Log::channel('js')->error($message);
    }

    /**
     * @param $message string
     * @param $error \Exception
     */
    public function errorMessageException($message, $error) {
        $errorMessage = $error->getMessage();
        $message = $message . "\n" . $errorMessage;
        $this->errorMessage($message);
    }
}
