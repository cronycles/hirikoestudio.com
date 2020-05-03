<?php

namespace App\ViewModels\Pages\Auth;

use App\Custom\Form\Models\FormModel;

class ResetPasswordPageViewModel extends AuthPageViewModel {

    /**
     * @var string
     */
    public $token;

    /**
     * @var FormModel
     */
    public $formData;

    public function __construct() {
        parent::__construct();
    }

}
