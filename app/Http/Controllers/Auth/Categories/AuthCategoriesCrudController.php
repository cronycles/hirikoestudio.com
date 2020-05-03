<?php

namespace App\Http\Controllers\Auth\Categories;

use App\Custom\CRUD\Controllers\CrudController;
use App\FormBuilders\CategoryFormBuilder;
use App\Http\Requests\CategoryRequest;
use App\Services\Categories\CategoriesCrudService;
use Illuminate\Http\Request;

class AuthCategoriesCrudController extends CrudController {

    public function __construct(
        CategoryFormBuilder $formBuilder,
        CategoriesCrudService $service) {

        parent::__construct($formBuilder, $service);

    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request) {
        return $this->crudStore(
            $request,
            'auth.categories',
            __('page-auth-category-create.messages.create-success'));
    }

    /**
     * @param CategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, int $id) {
        return $this->crudUpdate(
            $request,
            $id,
            'auth.categories',
            __('page-auth-category-edit.messages.edit-success'));
    }

    public function delete(Request $request, $id) {
        return $this->crudDelete(
            $request,
            $id,
            'auth.categories',
            __('page-auth-category-delete.messages.delete-success'));
    }
}
