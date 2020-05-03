<?php

namespace App\Custom\Form\Captcha\Services;

use App\Custom\Form\Captcha\Models\CaptchaModel;
use App\Custom\Logging\AppLog;

class CaptchaService {

    public function __construct() {
    }

    /**
     * @param string $formId
     * @return CaptchaModel
     */
    public function getModel($formId) {
        $outcome = new CaptchaModel();
        $outcome->formId = $formId;

        $outcome->key = config('custom.captcha.key');
        return $outcome;
    }

    /**
     * @var string $captcha
     * @return bool
     */
    public function validateCaptcha($captcha) {
        try {
            $outcome = false;
            if($captcha != null && !empty($captcha)) {
                $siteVerify = config("custom.captcha.siteVerify");
                $secret = config("custom.captcha.secret");
                $response = json_decode(file_get_contents($siteVerify."?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER["REMOTE_ADDR"]), true);
                $outcome = $response['success'];

                if(!$outcome) {
                    AppLog::errorMessage("error verifying captcha");
                }
            }

            return $outcome;
        }catch  (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }
}
