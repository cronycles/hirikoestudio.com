<?php

namespace App\ViewModels\Pages\Auth\Projects;

use App\Custom\Form\Models\FormModel;
use App\ViewModels\Pages\Auth\AuthPageViewModel;

class AuthProjectEditPageViewModel extends AuthPageViewModel {

    /**
     * @var string
     */
    public $noCategory;

    /**
     * @var string
     */
    public $addNewCategory;

    /**
     * @var FormModel
     */
    public $formData;

    public function __construct() {
        parent::__construct();
    }

}
