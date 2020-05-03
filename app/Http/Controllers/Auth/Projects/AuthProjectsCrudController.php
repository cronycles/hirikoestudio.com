<?php

namespace App\Http\Controllers\Auth\Projects;

use App\Custom\CRUD\Controllers\CrudController;
use App\FormBuilders\ProjectFormBuilder;
use App\Http\Requests\ProjectRequest;
use App\Services\Projects\ProjectsCrudService;
use Illuminate\Http\Request;

class AuthProjectsCrudController extends CrudController {

    public function __construct(
        ProjectFormBuilder $formBuilder,
        ProjectsCrudService $service) {

        parent::__construct($formBuilder, $service);
    }

    public function store(ProjectRequest $request) {
        return $this->crudStore(
            $request,
            'auth.projects',
            __('page-auth-project-create.messages.create-success'));
    }

    public function update(ProjectRequest $request, int $id) {
        return $this->crudUpdate(
            $request,
            $id,
            'auth.projects',
            __('page-auth-project-edit.messages.edit-success'));
    }

    public function delete(Request $request, $id) {
        return $this->crudDelete(
            $request,
            $id,
            'auth.projects',
            __('page-auth-project-delete.messages.delete-success'));
    }
}
