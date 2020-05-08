<?php

namespace App\ViewModels\Pages\Auth\Categories;

use App\Custom\Form\Models\FormModel;
use App\ViewModels\Pages\Auth\AuthPageViewModel;

class AuthCategoryCreatePageViewModel extends AuthPageViewModel {

    /**
     * @var FormModel
     */
    public $formData;

    public function __construct() {
        parent::__construct();
    }

}
