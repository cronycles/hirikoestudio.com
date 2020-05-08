<?php

namespace App\ViewModels\Pages;

use App\Custom\CRUD\ViewModels\CrudPageViewModelTrait;
use App\ViewModels\Pages\Auth\AuthPageViewModel;

class CrudPageViewModel extends AuthPageViewModel {

    use CrudPageViewModelTrait;

    public function __construct() {
        parent::__construct();
    }
}
