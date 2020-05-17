<?php

namespace App\ViewModels\Pages\Projects;

use App\ViewModels\Categories\CategoryViewModel;
use App\ViewModels\Pages\PageViewModel;
use App\ViewModels\Projects\ProjectViewModel;

class ProjectPageViewModel extends PageViewModel {

    /**
     * @var ProjectViewModel
     */
    public $project;

    /**
     * @var CategoryViewModel[]
     */
    public $categories;

    /**
     * @var ProjectViewModel[]
     */
    public $projects;

    /**
     * @var string
     */
    public $moreProjectsTitle;

    /**
     * @var string
     */
    public $moreProjectsDescription;

    public function __construct() {
        parent::__construct();
        $this->categories = [];
        $this->projects = [];
    }
}
