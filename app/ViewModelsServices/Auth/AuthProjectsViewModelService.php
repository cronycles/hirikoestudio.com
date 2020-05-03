<?php

namespace App\ViewModelsServices\Auth;

use App\Custom\Form\Models\FormModel;
use App\Entities\ProjectEntity;
use App\FormBuilders\ProjectFormBuilder;
use App\Services\Categories\CategoriesService;
use App\Custom\ImagesUploader\ViewModels\ImagesUploaderViewModel;
use App\Custom\Sorting\ViewModels\SortingItemViewModel;
use App\Custom\Sorting\ViewModels\SortingViewModel;
use App\ViewModelsServices\ImagesViewModelService;

class AuthProjectsViewModelService {

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * @var ImagesViewModelService
     */
    private $imagesViewModelService;

    /**
     * @var ProjectFormBuilder
     */
    private $formBuilder;

    public function __construct(
        CategoriesService $categoriesService,
        ImagesViewModelService $imagesViewModelService,
        ProjectFormBuilder $formBuilder) {

        $this->categoriesService = $categoriesService;
        $this->imagesViewModelService = $imagesViewModelService;
        $this->formBuilder = $formBuilder;
    }

    /**
     * @param string $actionUrl the url of submit form
     * @param string $saveTextButton text of save button
     * @param ProjectEntity $projectEntity the entity to get the values for the form fields
     * @return FormModel
     */
    public function createFormDataViewModel($actionUrl, $saveTextButton, $projectEntity = null) {
        return $this->formBuilder->createFormViewModelByConfigurationAndEntity($actionUrl, $saveTextButton, $projectEntity);
    }

    /**
     * @param ProjectEntity[] $entities
     * @return SortingViewModel
     */
    public function createSortingViewModelByEntities($entities) {
        $outcome = new SortingViewModel();
        if ($entities != null and !empty($entities)) {
            $outcome->updateUrl = route('auth.projects.sort');

            /** @var ProjectEntity $entity */
            foreach ($entities as $entity) {
                if ($entity != null) {
                    $sortingItem = new SortingItemViewModel($entity->id, $entity->title);
                    array_push($outcome->items, $sortingItem);
                }
            }
        }

        return $outcome;
    }

    /**
     * @param ProjectEntity $projectEntity
     * @return ImagesUploaderViewModel
     */
    public function createImagesUploaderViewModel($projectEntity = null) {
        $outcome = new ImagesUploaderViewModel();
        $outcome->images = $this->imagesViewModelService->createImagesViewModel($projectEntity->images, false);
        $outcome->uploadApiUrl = route('auth.projects.images.upload', $projectEntity->id);
        $outcome->updateSortApiUrl = route('auth.projects.imagesSort', $projectEntity->id);
        $outcome->maxNumberOfFiles = config('custom.images.upload.maxNumberOfFiles');
        return $outcome;

    }

}
