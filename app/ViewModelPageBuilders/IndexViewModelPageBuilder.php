<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\ViewModels\Pages\Index\IndexViewModel;
use App\ViewModels\Pages\PageViewModel;

class IndexViewModelPageBuilder extends ViewModelPageBuilder {

    public function __construct() {

    }

    public function createNewViewModel() {
        return new IndexViewModel();
    }

    /**
     * @param PageViewModel $pageViewModel
     * @param array $params
     * @return PageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        return $pageViewModel;
    }

}
