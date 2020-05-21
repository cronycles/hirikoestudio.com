<?php


namespace App\Custom\CRUD\Controllers;


use App\Custom\CRUD\Services\CrudService;
use App\Custom\CRUD\Services\ICrudService;
use App\Custom\Form\Builders\FormBuilder;
use App\Custom\HttpMessages\Services\HttpMessagesService;
use App\Custom\Logging\AppLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

abstract class CrudController extends Controller{

    /**
     * @var HttpMessagesService
     */
    private $messagesService;

    /**
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * @var CrudService
     */
    private $service;

    public function __construct(
        FormBuilder $formBuilder,
        CrudService $service) {

        $this->messagesService = new HttpMessagesService();
        $this->formBuilder = $formBuilder;
        $this->service = $service;
    }

    /**
     * @param CategoryRequest $request
     * @param string $successRedirectRoute
     * @param string $successMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crudStore(Request $request, string $successRedirectRoute, string $successMessage) {
        try {
            $entity = $this->formBuilder->createEntityFromRequest($request);

            $outcome = $this->service->storeEntity($entity);

            if($outcome != null && $outcome === true) {
                $outcome = $this->messagesService->createSuccessResponse(
                    $successMessage,
                    $successRedirectRoute);

            }
            else {
                $outcome = $this->messagesService->createResponseWithGenericError();
            }

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->messagesService->createResponseWithGenericError();
        }
    }

    /**
     * @param CategoryRequest $request
     * @param int $entityId
     * @param string $successRedirectRoute
     * @param string $successMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crudUpdate(Request $request, int $entityId, string $successRedirectRoute, string $successMessage) {
        try {
            $entity = $this->formBuilder->createEntityFromRequest($request);
            $entity->id = $entityId;

            $outcome = $this->service->updateEntity($entity);
            if($outcome != null && $outcome === true) {
                $outcome = $this->messagesService->createSuccessResponse(
                    $successMessage,
                    $successRedirectRoute);
            }
            else {
                $outcome = $this->messagesService->createResponseWithGenericError();
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->messagesService->createResponseWithGenericError();
        }
    }

    public function crudDelete(Request $request, int $entityId, string $successRedirectRoute, string $successMessage) {
        try {
            $outcome = $this->service->deleteEntity($entityId);
            if($outcome != null && $outcome === true) {
                $outcome = $this->messagesService->createSuccessResponse(
                    $successMessage,
                    $successRedirectRoute);
            }
            else {
                $outcome = $this->messagesService->createResponseWithGenericError();
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->messagesService->createResponseWithGenericError();
        }
    }

}
