<?php

namespace App\ViewModels\Pages\Auth\Categories;

use App\Custom\Sorting\ViewModels\SortingPageViewModelTrait;
use App\ViewModels\Pages\Auth\AuthPageViewModel;

class AuthCategoriesSortPageViewModel extends AuthPageViewModel {

    use SortingPageViewModelTrait;

    public function __construct() {
        parent::__construct();
    }
}
