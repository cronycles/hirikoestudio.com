<?php

namespace App\ViewModels\Pages\Auth;

use App\Custom\Form\Models\FormModel;

class LoginPageViewModel extends AuthPageViewModel {

    /**
     * @var string
     */
    public $forgotPasswordText;

    /**
     * @var string
     */
    public $forgotPasswordUrl;

    /**
     * @var FormModel
     */
    public $formData;

    public function __construct() {
        parent::__construct();
    }

}
