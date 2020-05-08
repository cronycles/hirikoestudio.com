<?php

namespace App\ViewModels\Pages\Contact;

use App\ViewModels\Form\FormModel;
use App\ViewModels\Pages\PageViewModel;

class ContactPageViewModel extends PageViewModel {

    /**
     * @var FormModel
     */
    public $formData;

    /**
     * @var InfoViewModel
     */
    public $infoData;

    public function __construct() {
        parent::__construct();
    }
}
