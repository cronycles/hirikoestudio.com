<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
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
     * @var CategoriesViewModelService
     */
    private $categoryViewModelService;

    /**
    * @var ProjectsViewModelService
    */
    private $projectsViewModelService;

    public function __construct(
        ProjectsService $projectsService,
        CategoriesService $categoriesService,
        ProjectsViewModelService $projectsViewModelService,
        CategoriesViewModelService $categoryViewModelService) {

        $this->projectsService = $projectsService;
        $this->categoriesService = $categoriesService;
        $this->projectsViewModelService = $projectsViewModelService;
        $this->categoryViewModelService = $categoryViewModelService;
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

        $allCategory = $this->categoryViewModelService->createCategoryAllViewModel();
        array_push($pageViewModel->categories, $allCategory);

        $projectEntities = $this->projectsService->getProjects();
        $categoriesEntities = $this->categoriesService->getCategories();

        $pageViewModel->projects = $this->projectsViewModelService->createProjectsModel($projectEntities);

        $projectsCategoryIds = [];
        if ($projectEntities != null and !empty($projectEntities)) {
            /** @var ProjectEntity $projectEntityEntity */
            foreach ($projectEntities as $projectEntityEntity) {
                if ($projectEntityEntity != null) {
                    array_push($projectsCategoryIds, $projectEntityEntity->category->id);
                }
            }
        }

        foreach ($categoriesEntities as $categoryEntity) {
            if(in_array($categoryEntity->id, $projectsCategoryIds)) {
                $categoryViewModel = $this->categoryViewModelService->createCategoryViewModelByEntity($categoryEntity);
                array_push($pageViewModel->categories, $categoryViewModel);
            }
        }

        return $pageViewModel;
    }

}
