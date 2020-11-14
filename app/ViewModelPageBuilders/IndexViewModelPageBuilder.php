<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\Services\Carousel\CarouselImagesService;
use App\Services\Projects\ProjectsService;
use App\ViewModels\Pages\Index\IndexProjectsSectionViewModel;
use App\ViewModels\Pages\Index\IndexPresentationSectionViewModel;
use App\ViewModels\Pages\Index\IndexSlidesSectionViewModel;
use App\ViewModels\Pages\Index\IndexViewModel;
use App\ViewModels\Pages\Index\SlideViewModel;
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

    /**
     * @var CarouselImagesService
     */
    private $carouselImagesService;


    public function __construct(
        ProjectsService $projectsService,
        CarouselImagesService $carouselImagesService,
        ProjectsViewModelService $projectsViewModelService) {

        $this->projectsService = $projectsService;
        $this->carouselImagesService = $carouselImagesService;
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
        $pageViewModel->presentationSection = $this->fillPresentationSection();
        $pageViewModel->projectsSection = $this->fillProjectsSection();

        return $pageViewModel;
    }

    /**
     * @return IndexSlidesSectionViewModel
     */
    private function fillSlidesSection() {
        $outcome = new IndexSlidesSectionViewModel();

        $carouselImagesEntities = $this->carouselImagesService->getCarouselImages();
        foreach ($carouselImagesEntities as $carouselImagesEntity) {
            $slide = new SlideViewModel();
            $slide->imageAltText = config('custom.company.name');
            $slide->imageUrl = $carouselImagesEntity->image->url;
            $slide->isMobileSlide = $carouselImagesEntity->isMobile;
            array_push($outcome->slides, $slide);
        }
        return $outcome;
    }

    /**
     * @return IndexPresentationSectionViewModel
     */
    private function fillPresentationSection() {
        $outcome = new IndexPresentationSectionViewModel();

        $outcome->title = __('page-index.presentation-section-title');
        $outcome->subtitle = __('page-index.presentation-section-subtitle');
        $outcome->text = __('page-index.presentation-section-text');

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
