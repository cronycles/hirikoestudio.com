<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\Entities\ProjectEntity;
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

        $projectId = $params['id'];

        $pageViewModel = $this->fillMainSection($pageViewModel, $projectId);
        $pageViewModel = $this->fillMoreProjectsSection($pageViewModel, $projectId);

        return $pageViewModel;
    }

    /**
     * @param ProjectPageViewModel $pageViewModel
     * @param int $projectId
     * @return ProjectPageViewModel
     */
    private function fillMainSection(ProjectPageViewModel $pageViewModel, int $projectId) {

        $projectEntity = $this->projectsService->getProjectById($projectId);
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
     * @param int $projectId
     * @return ProjectPageViewModel
     */
    private function fillMoreProjectsSection(ProjectPageViewModel $pageViewModel, int $projectId) {

        $projectEntities = $this->projectsService->getProjects();
        $categoriesEntities = $this->categoriesService->getCategories();

        $pageViewModel->moreProjectsTitle = __('page-project-show.moreProjectsTitle');
        $pageViewModel->moreProjectsDescription = __('page-project-show.moreProjectsDescription');

        $projectEntities = $this->removeCurrentProjectFromTheListOfOtherProjects($projectEntities, $projectId);

        $pageViewModel->categories = $this->projectsViewModelService->createCategoriesViewModelByEntities($categoriesEntities, $projectEntities);
        $pageViewModel->projects = $this->projectsViewModelService->createProjectsModel($projectEntities);

        return $pageViewModel;
    }

    /**
     * @param ProjectEntity[] $projectEntities
     * @param int $projectId
     * @return ProjectEntity[]
     */
    private function removeCurrentProjectFromTheListOfOtherProjects(array $projectEntities, int $projectId) {
        $outcome = [];
        if ($projectEntities != null && !empty($projectEntities)) {
            foreach ($projectEntities as $projectEntity) {
                if ($projectEntity != null && $projectEntity->id != $projectId) {
                    array_push($outcome, $projectEntity);
                }
            }
        }

        return $outcome;
    }


}
