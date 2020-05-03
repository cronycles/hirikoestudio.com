<?php

namespace App\Custom\Form\Models;

use App\Custom\Form\Captcha\Models\CaptchaModel;
use App\Custom\Form\Models\Fields\FieldModel;

class FormModel {

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $actionUrl;

    /**
     * @var FieldModel[]
     */
    public $fields;

    /**
     * @var string
     */
    public $buttonText;

    /**
     * @var CaptchaModel
     */
    public $captcha;


    public function __construct() {
    }
}
