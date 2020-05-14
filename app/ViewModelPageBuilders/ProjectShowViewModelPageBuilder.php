<?php

namespace App\ViewModelPageBuilders;


use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\Services\Projects\ProjectsService;
use App\ViewModels\Pages\Projects\ProjectPageViewModel;
use App\ViewModelsServices\ProjectsViewModelService;

class ProjectShowViewModelPageBuilder extends ViewModelPageBuilder {

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
        return new ProjectPageViewModel();
    }

    /**
     * @param ProjectPageViewModel $pageViewModel
     * @param array $params
     * @return ProjectPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $projectEntity = $this->projectsService->getProjectById($params['id']);
        $pageViewModel->title = $projectEntity->title;
        $pageViewModel->description = $projectEntity->description;
        $pageViewModel->project = $this->projectsViewModelService->createProjectModel($projectEntity);

        if ($pageViewModel->project != null && $pageViewModel->project->cover != null && !empty($pageViewModel->project->cover->url)) {
            $pageViewModel->ogImageUrl = $pageViewModel->project->cover->url;
        }

        return $pageViewModel;
    }

}
