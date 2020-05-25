<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\Services\Projects\ProjectsService;
use App\ViewModels\Pages\Index\IndexProjectsSectionViewModel;
use App\ViewModels\Pages\Index\IndexViewModel;
use App\ViewModels\Pages\Index\SlideViewModel;
use App\ViewModels\Pages\PageViewModel;
use App\ViewModelsServices\ProjectsViewModelService;

class IndexViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var ProjectsService
     */
    private $projectsService;

    /**
     * @var ProjectsViewModelService
     */
    private $projectsViewModelService;


    public function __construct(
        ProjectsService $projectsService,
        ProjectsViewModelService $projectsViewModelService) {

        $this->projectsService = $projectsService;
        $this->projectsViewModelService = $projectsViewModelService;
    }

    public function createNewViewModel() {
        return new IndexViewModel();
    }

    /**
     * @param IndexViewModel $pageViewModel
     * @param array $params
     * @return IndexViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $imageBaseUrl = config('custom.images.static.homeSlidesUrl');
        $numberOfSlidesToShow = config('pages.index.slidesNumber');

        for ($i = 0; $i < $numberOfSlidesToShow; $i++) {
            $slide = new SlideViewModel();
            $slide->imageAltText = config('custom.company.name');
            $slidePartialName = $imageBaseUrl . '/home-slide' . ($i + 1);
            $slide->imageDesktopUrl = $slidePartialName . "-d.jpg";
            $slide->imageMobileUrl = $slidePartialName . "-m.jpg";

            array_push($pageViewModel->slides, $slide);
        }

        $pageViewModel->projectsSection = $this->fillProjectsSection();

        return $pageViewModel;
    }

    /**
     * @return IndexProjectsSectionViewModel
     */
    private function fillProjectsSection() {
        $outcome = new IndexProjectsSectionViewModel();

        $projectEntities = $this->projectsService->getHomeProjects();

        $outcome->title = __('page-index.projects-section-title');
        $outcome->seeMore = __('page-index.projects-section-more');

        $outcome->projects = $this->projectsViewModelService->createProjectsModel($projectEntities);

        return $outcome;
    }

}
