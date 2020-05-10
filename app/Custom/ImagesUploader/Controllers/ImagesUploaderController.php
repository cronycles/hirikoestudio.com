<?php

namespace App\Custom\ImagesUploader\Controllers;

use App\Custom\Ajax\CustomAjaxController;
use App\Custom\ImagesUploader\Services\ImagesUploaderService;
use App\Custom\Logging\AppLog;
use Illuminate\Http\Request;

abstract class ImagesUploaderController extends CustomAjaxController {

    /**
     * @var ImagesUploaderService
     */
    private $service;

    public function __construct(ImagesUploaderService $service) {

        $this->service = $service;
    }

    public function uploadImages($entityId, Request $request) {
        try {
            $file = $request->file("uploaded_file");

            $savedImageId = 0;
            if ($file != null) {
                $savedImageId = $this->service->saveImage($entityId, $file);
            }

            return $this->getResponseForAjaxCall(
                ["imageId" => $savedImageId],
                $savedImageId == null && $savedImageId <= 0);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function deleteImage($entityId, $imageId) {
        try {
            $isDeleted = false;
            if ($entityId != null && $imageId != null) {
                $isDeleted = $this->service->deleteImage($entityId, $imageId);
            }

            $hasErrors = $isDeleted == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function updateImagesSort(Request $request, $offerId) {
        try {
            $imagesSortedIds = $request->input('images-ids');
            $isSortedOk = $this->service->updateImagesSort($offerId, $imagesSortedIds);

            $hasErrors = $isSortedOk == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function changeSmallView(Request $request, $entityId, $imageId) {
        try {
            $isSmallViewChanged = false;
            $isActive = $request->input('is-active');
            if ($entityId != null && $imageId != null) {
                $isSmallViewChanged = $this->service->changeSmallView($entityId, $imageId, $isActive);
            }

            $hasErrors = $isSmallViewChanged == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

}
