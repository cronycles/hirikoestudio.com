<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\Services\Projects\ProjectsService;
use App\ViewModels\Pages\Index\IndexProjectsSectionViewModel;
use App\ViewModels\Pages\Index\IndexServicesSectionViewModel;
use App\ViewModels\Pages\Index\IndexSlidesSectionViewModel;
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
        $pageViewModel->slidesSection = $this->fillSlidesSection();
        $pageViewModel->servicesSection = $this->fillServicesSection();
        $pageViewModel->projectsSection = $this->fillProjectsSection();

        return $pageViewModel;
    }

    /**
     * @return IndexSlidesSectionViewModel
     */
    private function fillSlidesSection() {
        $imageBaseUrl = config('custom.images.static.homeSlidesUrl');
        $numberOfSlidesToShow = config('pages.index.slidesNumber');

        $outcome = new IndexSlidesSectionViewModel();

        for ($i = 0; $i < $numberOfSlidesToShow; $i++) {
            $slide = new SlideViewModel();
            $slide->imageAltText = config('custom.company.name');
            $slidePartialName = $imageBaseUrl . '/home-slide' . ($i + 1);
            $slide->imageDesktopUrl = $slidePartialName . "-d.jpg";
            $slide->imageMobileUrl = $slidePartialName . "-m.jpg";

            array_push($outcome->slides, $slide);
        }

        return $outcome;
    }

    /**
     * @return IndexServicesSectionViewModel
     */
    private function fillServicesSection() {
        $outcome = new IndexServicesSectionViewModel();

        $outcome->companyName = config('custom.company.name');
        $outcome->companyText = __('page-index.services-company-text');

        return $outcome;
    }

    /**
     * @return IndexProjectsSectionViewModel
     */
    private function fillProjectsSection() {
        $outcome = new IndexProjectsSectionViewModel();

        $projectEntities = $this->projectsService->getHomeProjects();

        $outcome->title = __('page-index.projects-section-title');
        $outcome->seeMoreText = __('page-index.projects-section-more');
        $outcome->seeMoreUrl = route('projects');

        $outcome->projects = $this->projectsViewModelService->createProjectsModel($projectEntities);

        return $outcome;
    }

}
