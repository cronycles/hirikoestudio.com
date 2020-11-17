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

    public function uploadImages(Request $request, $entityId = null) {
        try {
            $file = $request->file("uploaded_file");

            $savedImageId = 0;
            if ($file != null) {
                $savedImageId = $this->service->saveImage($file, $entityId);
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
                $isDeleted = $this->service->deleteImage($imageId, $entityId);
            }

            $hasErrors = $isDeleted == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function deleteImageNoEntity($imageId) {
        try {
            $isDeleted = false;
            if ($imageId != null) {
                $isDeleted = $this->service->deleteImage($imageId);
            }

            $hasErrors = $isDeleted == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function updateImagesSort(Request $request, $entityId) {
        try {
            $imagesSortedIds = $request->input('images-ids');
            $isSortedOk = $this->service->updateImagesSort($imagesSortedIds, $entityId);

            $hasErrors = $isSortedOk == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function updateImagesSortNoEntity(Request $request) {
        try {
            $imagesSortedIds = $request->input('images-ids');
            $isSortedOk = $this->service->updateImagesSort($imagesSortedIds);

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
                $isSmallViewChanged = $this->service->changeSmallView($imageId, $entityId, $isActive);
            }

            $hasErrors = $isSmallViewChanged == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function changeSmallViewNoEntity(Request $request, $imageId) {
        try {
            $isSmallViewChanged = false;
            $isActive = $request->input('is-active');
            if ($imageId != null) {
                $isSmallViewChanged = $this->service->changeSmallView($imageId, null, $isActive);
            }

            $hasErrors = $isSmallViewChanged == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function changeIsMobileProperty(Request $request, $entityId, $imageId) {
        try {
            $isMobilePropertyChanged = false;
            $isActive = $request->input('is-active');
            if ($entityId != null && $imageId != null) {
                $isMobilePropertyChanged = $this->service->changeIsMobileProperty($imageId, $entityId, $isActive);
            }

            $hasErrors = $isMobilePropertyChanged == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function changeIsMobilePropertyNoEntity(Request $request, $imageId) {
        try {
            $isMobilePropertyChanged = false;
            $isActive = $request->input('is-active');
            if ($imageId != null) {
                $isMobilePropertyChanged = $this->service->changeIsMobileProperty($imageId, null, $isActive);
            }

            $hasErrors = $isMobilePropertyChanged == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

}
