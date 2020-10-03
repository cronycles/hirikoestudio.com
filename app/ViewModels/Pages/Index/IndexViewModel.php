<?php

namespace App\ViewModels\Pages\Index;

use App\ViewModels\Pages\PageViewModel;

class IndexViewModel extends PageViewModel {

    /**
     * @var IndexSlidesSectionViewModel
     */
    public $slidesSection;

    /**
     * @var IndexPresentationSectionViewModel
     */
    public $presentationSection;

    /**
     * @var IndexProjectsSectionViewModel
     */
    public $projectsSection;

    public function __construct() {
        parent::__construct();
    }

}
