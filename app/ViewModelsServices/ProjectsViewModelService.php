<?php

namespace App\ViewModelsServices;

use App\Entities\ProjectEntity;
use App\ViewModels\Projects\ProjectViewModel;

class ProjectsViewModelService {

    /**
     * @var CategoriesViewModelService
     */
    private $categoriesViewModelService;

    /**
     * @var ImagesViewModelService
     */
    private $imagesViewModelService;

    public function __construct(
        CategoriesViewModelService $categoriesViewModelService,
        ImagesViewModelService $imagesViewModelService) {

        $this->categoriesViewModelService = $categoriesViewModelService;
        $this->imagesViewModelService = $imagesViewModelService;
    }

    /**
     * @param ProjectEntity[] $projectEntities
     * @return ProjectViewModel[]
     */
    public function createProjectsModel($projectEntities) {
        $outcome = [];
        if ($projectEntities != null and !empty($projectEntities)) {
            /** @var ProjectEntity $projectEntity */
            foreach ($projectEntities as $projectEntity) {
                if ($projectEntity != null) {
                    $projectViewModel = $this->createProjectModel($projectEntity);
                    if ($projectViewModel != null) {
                        array_push($outcome, $projectViewModel);
                    }
                }
            }
        }

        return $outcome;
    }

    /**
     * @param ProjectEntity $projectEntity
     * @return ProjectViewModel
     */
    public function createProjectModel($projectEntity) {
        $outcome = null;
        if ($projectEntity != null) {
            $outcome = new ProjectViewModel();
            $outcome->category = $this->categoriesViewModelService->createCategoryViewModelByEntity($projectEntity->category);
            $outcome->title = $projectEntity->title;
            $outcome->description = $projectEntity->description;
            $outcome->url = route('projects.show', $projectEntity->id);
            $outcome->cover = $this->imagesViewModelService->createImageCoverViewModelByImageEntityList($projectEntity->images);
            $outcome->images = $this->imagesViewModelService->createImagesViewModel($projectEntity->images);
            $outcome->viewText = trans('gallery.view');
        }

        return $outcome;

    }

}
