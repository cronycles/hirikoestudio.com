<?php

namespace App\Http\Controllers;

use App\Custom\Ajax\CustomAjaxController;
use App\Custom\Logging\Controllers\JsLoggingControllerTrait;

class JsLoggingController extends CustomAjaxController {

    use JsLoggingControllerTrait;
}
