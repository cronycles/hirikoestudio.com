<?php

namespace App\ViewModels\Pages\Index;


use App\ViewModels\Projects\ProjectViewModel;

class IndexProjectsSectionViewModel {

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $seeMoreText;

    /**
     * @var string
     */
    public $seeMoreUrl;

    /**
     * @var ProjectViewModel[]
     */
    public $projects;

    public function __construct() {
        $this->projects = [];

    }

}
