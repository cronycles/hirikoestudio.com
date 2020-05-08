<?php

namespace App\ViewModels\Pages\Projects;

use App\ViewModels\Pages\PageViewModel;
use App\ViewModels\Projects\ProjectViewModel;

class ProjectPageViewModel extends PageViewModel {

    /**
     * @var ProjectViewModel
     */
    public $project;

    public function __construct() {
        parent::__construct();
    }
}
