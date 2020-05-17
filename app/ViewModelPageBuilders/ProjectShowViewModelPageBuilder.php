<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\Services\Categories\CategoriesService;
use App\Services\Projects\ProjectsService;
use App\ViewModels\Pages\Projects\ProjectPageViewModel;
use App\ViewModelsServices\ProjectsViewModelService;

class ProjectShowViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var ProjectsService
     */
    private $projectsService;

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * @var ProjectsViewModelService
     */
    private $projectsViewModelService;

    public function __construct(
        ProjectsService $projectsService,
        CategoriesService $categoriesService,
        ProjectsViewModelService $projectsViewModelService) {

        $this->projectsService = $projectsService;
        $this->categoriesService = $categoriesService;
        $this->projectsViewModelService = $projectsViewModelService;
    }

    public function createNewViewModel() {
        return new ProjectPageViewModel();
    }

    /**
     * @param ProjectPageViewModel $pageViewModel
     * @param array $params
     * @return ProjectPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $pageViewModel = $this->fillMainSection($pageViewModel, $params);
        $pageViewModel = $this->fillMoreProjectsSection($pageViewModel);

        return $pageViewModel;
    }

    /**
     * @param ProjectPageViewModel $pageViewModel
     * @param array $params
     * @return ProjectPageViewModel
     */
    private function fillMainSection($pageViewModel, $params) {

        $projectEntity = $this->projectsService->getProjectById($params['id']);
        $pageViewModel->title = $projectEntity->title;
        $pageViewModel->description = $projectEntity->description;
        $pageViewModel->project = $this->projectsViewModelService->createProjectModel($projectEntity);

        if ($pageViewModel->project != null && $pageViewModel->project->cover != null && !empty($pageViewModel->project->cover->url)) {
            $pageViewModel->ogImageUrl = $pageViewModel->project->cover->url;
        }

        return $pageViewModel;
    }

    /**
     * @param ProjectPageViewModel $pageViewModel
     * @param array $params
     * @return ProjectPageViewModel
     */
    private function fillMoreProjectsSection($pageViewModel) {

        $projectEntities = $this->projectsService->getProjects();
        $categoriesEntities = $this->categoriesService->getCategories();

        $pageViewModel->moreProjectsTitle = __('page-project-show.moreProjectsTitle');
        $pageViewModel->moreProjectsDescription = __('page-project-show.moreProjectsDescription');

        $pageViewModel->projects = $this->projectsViewModelService->createProjectsModel($projectEntities);
        $pageViewModel->categories = $this->projectsViewModelService->createCategoriesViewModelByEntities($categoriesEntities, $projectEntities);

        return $pageViewModel;
    }

}
