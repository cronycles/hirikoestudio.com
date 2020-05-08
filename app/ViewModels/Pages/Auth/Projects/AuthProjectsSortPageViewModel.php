<?php

namespace App\ViewModels\Pages\Auth\Projects;

use App\Custom\Sorting\ViewModels\SortingPageViewModelTrait;
use App\ViewModels\Pages\Auth\AuthPageViewModel;

class AuthProjectsSortPageViewModel extends AuthPageViewModel {

    use SortingPageViewModelTrait;

    public function __construct() {
        parent::__construct();
    }
}
