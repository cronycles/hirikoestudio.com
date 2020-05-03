<?php

namespace App\Custom\ImagesUploader\Controllers;

use App\Custom\ImagesUploader\Services\ImagesUploaderService;
use App\Custom\Logging\AppLog;
use Illuminate\Http\Request;

abstract class ImagesUploaderController {

    /**
     * @var ImagesUploaderService
     */
    private $service;

    public function __construct(ImagesUploaderService $service) {

        $this->service = $service;
    }

    public function uploadImages($offerId, Request $request) {

        $file = $request->file("uploaded_file");

        $savedImageId = 0;
        if ($file != null) {
            $savedImageId = $this->service->saveImage($offerId, $file);
        }

        return $this->getResponseForAjaxCall(
            ["imageId" => $savedImageId],
            $savedImageId == null && $savedImageId <= 0);
    }

    public function deleteImage($offerId, $imageId) {

        if ($offerId != null && $imageId != null) {
            $isDeleted = $this->service->deleteImage($offerId, $imageId);
        }

        return $this->getResponseForAjaxCall(null, $isDeleted);
    }

    public function updateImagesSort(Request $request, $offerId) {
        $imagesSortedIds = $request->input('images-ids');
        $this->service->updateImagesSort($offerId, $imagesSortedIds);
    }

    /**
     * @param string[] $errorList
     * @return \Illuminate\Http\JsonResponse
     */
    private function getResponseForAjaxCall(array $parameters = null, bool $hasError = false,  array $errorList = null) {
        $response = [];
        if ($parameters != null || !empty($parameters)) {
            $response['params'] = $parameters;
        }
        if ($errorList != null || !empty($errorList)) {
            $response['errors'] = $errorList;
            $hasError = true;
        }
        $response['hasError'] = $hasError;
        return response()->json($response, 200);
    }

}
