<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Logging\AppLog;
use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\Entities\CategoryEntity;
use App\Entities\ProjectEntity;
use App\Services\Categories\CategoriesService;
use App\Services\Projects\ProjectsService;
use App\ViewModels\Pages\Projects\ProjectsPageViewModel;
use App\ViewModelsServices\CategoriesViewModelService;
use App\ViewModelsServices\ProjectsViewModelService;

class ProjectsViewModelPageBuilder extends ViewModelPageBuilder {

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
        return new ProjectsPageViewModel();
    }

    /**
     * @param ProjectsPageViewModel $pageViewModel
     * @param array $params
     * @return ProjectsPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $projectEntities = $this->projectsService->getProjects();
        $categoriesEntities = $this->categoriesService->getCategories();

        $pageViewModel->projects = $this->projectsViewModelService->createProjectsModel($projectEntities);

        $pageViewModel->categories = $this->projectsViewModelService->createCategoriesViewModelByEntities($categoriesEntities, $projectEntities);

        return $pageViewModel;
    }


}
