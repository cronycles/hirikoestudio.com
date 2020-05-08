<?php

namespace App\ViewModelPageBuilders\Auth\Projects;

use App\Entities\ProjectEntity;
use App\Services\Projects\ProjectsService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\Custom\CRUD\ViewModels\CrudLinkViewModel;
use App\Custom\CRUD\ViewModels\CrudTableItemViewModel;
use App\Custom\CRUD\ViewModels\CrudTableViewModel;
use App\ViewModels\Pages\Auth\Projects\AuthProjectsIndexPageViewModel;

class AuthProjectsViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var ProjectsService
     */
    private $service;

    public function __construct(
        ProjectsService $service) {

        $this->service = $service;
    }

    public function createNewViewModel() {
        return new AuthProjectsIndexPageViewModel();
    }

    /**
     * @param AuthProjectsIndexPageViewModel $pageViewModel
     * @param array $params
     * @return AuthProjectsIndexPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $entities = $this->service->getProjects(false);

        $pageViewModel->createLink = new CrudLinkViewModel(route('auth.projects.create'), __('page-auth-projects.create-new-button'));
        $pageViewModel->sortLink = new CrudLinkViewModel(route('auth.projects.sort'), __('page-auth-projects.sort-button'));

        $pageViewModel->crudTable = $this->createCrudTableViewModel($entities);
        return $pageViewModel;
    }

    /**
     * @param ProjectEntity[] $entities
     * @return CrudTableViewModel
     */
    private function createCrudTableViewModel(array $entities) {
        $outcome = new CrudTableViewModel();
        $outcome->isEditingEnabled = true;
        $outcome->isImagesEditingEnabled = true;
        $outcome->isDeletingEnabled = true;

        if($entities != null && !empty($entities)) {
            foreach ($entities as $entity) {
                $crudItem = new CrudTableItemViewModel();

                $crudItem->name = $entity->title;
                $crudItem->editUrl = route('auth.projects.edit', ['id' =>$entity->id]);
                $crudItem->imagesUrl = route('auth.projects.images', ['id' =>$entity->id]);
                $crudItem->deleteUrl = route('auth.projects.delete', ['id' =>$entity->id]);
                array_push($outcome->items, $crudItem);
            }
        }

        return $outcome;
    }

}
