<?php

namespace App\ViewModels\Pages\Auth;

use App\Custom\Form\Models\FormModel;

class RegisterPageViewModel extends AuthPageViewModel {

    /**
     * @var FormModel
     */
    public $formData;

    public function __construct() {
        parent::__construct();
    }

}
