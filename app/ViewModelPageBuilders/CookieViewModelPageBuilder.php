<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Contact\ContactPageViewModel;

class CookieViewModelPageBuilder extends ViewModelPageBuilder {

    public function __construct() {
    }

    public function createNewViewModel() {
        return new ContactPageViewModel();
    }

    public function fillPageViewModel($pageViewModel, $params) {
        return $pageViewModel;
    }
}
