<?php

namespace App\Custom\Pages\Builders;

use App\ViewModels\Pages\PageViewModel;

abstract class ViewModelPageBuilder {

    /**
     * @return PageViewModel
     */
    public abstract function createNewViewModel();

    /**
     * @param PageViewModel $outcome
     * @param array $params
     * @return PageViewModel
     */
    public abstract function fillPageViewModel(PageViewModel $outcome, $params);

}
