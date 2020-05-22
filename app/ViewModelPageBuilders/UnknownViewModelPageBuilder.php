<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Unknown\UnknownViewModel;

class UnknownViewModelPageBuilder extends ViewModelPageBuilder {

    public function __construct() {

    }

    public function createNewViewModel() {
        return new UnknownViewModel();
    }

    /**
     * @param UnknownViewModel $pageViewModel
     * @param array $params
     * @return UnknownViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        return $pageViewModel;
    }

}
