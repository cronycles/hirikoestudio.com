<?php

namespace App\ViewModelsServices;

use App\Custom\Logging\AppLog;
use App\Entities\CategoryEntity;
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

    /**
     * @param CategoryEntity[] $categoriesEntities
     * @param ProjectEntity[] $projectEntities
     */
    public function createCategoriesViewModelByEntities(array $categoriesEntities, array $projectEntities) {
        try {
            $outcome = [];

            $projectsCategoryIds = $this->getCategoryIdsOfProjectEntities($projectEntities);

            if ($categoriesEntities != null && count($categoriesEntities) > 1) {
                foreach ($categoriesEntities as $categoryEntity) {
                    if (in_array($categoryEntity->id, $projectsCategoryIds)) {
                        $categoryViewModel = $this->categoriesViewModelService->createCategoryViewModelByEntity($categoryEntity);
                        array_push($outcome, $categoryViewModel);
                    }
                }
            }

            if (count($outcome) > 1) {
                $allCategory = $this->categoriesViewModelService->createCategoryAllViewModel();
                array_unshift($outcome, $allCategory);
            } else {
                $outcome = [];
            }


            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return [];
        }

    }

    /**
     * @param ProjectEntity[] $projectEntities
     * @return int[]
     */
    private function getCategoryIdsOfProjectEntities(array $projectEntities) {
        $outcome = [];
        if ($projectEntities != null and !empty($projectEntities)) {
            /** @var ProjectEntity $projectEntityEntity */
            foreach ($projectEntities as $projectEntityEntity) {
                if ($projectEntityEntity != null) {
                    array_push($outcome, $projectEntityEntity->category->id);
                }
            }
        }

        return $outcome;
    }

}
