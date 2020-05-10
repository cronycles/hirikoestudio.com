<?php

namespace App\Custom\ImagesUploader\Services;

use App\Custom\ImagesUploader\Api\IImagesUploaderApi;
use App\Custom\Logging\AppLog;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class ImagesUploaderService {

    /**
     * @var IImagesUploaderApi
     */
    private $api;

    public function __construct(IImagesUploaderApi $api) {
        $this->api = $api;
    }

    public function saveImage(int $id, UploadedFile $file) {
        try {
            $outcome = null;

            $savedImageId = $this->api->saveImage($id, $file);

            if ($savedImageId != null && $savedImageId > 0) {
                $outcome = $savedImageId;
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param int $entityId
     * @param int $imageId
     * @return bool
     */
    public function deleteImage($entityId, $imageId) {
        try {
            $outcome = false;
            if ($entityId != null && $imageId != null) {
                $outcome = $this->api->deleteImage($entityId, $imageId);
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param int $entityId
     * @param array $imagesSortedIds
     */
    public function updateImagesSort(int $entityId, array $imagesSortedIds) {
        return $this->api->updateImagesSort($entityId, $imagesSortedIds);
    }

    /**
     * @param int $entityId
     * @param int $imageId
     * @param bool $value
     */
    public function changeSmallView(int $entityId, int $imageId, bool $value = true) {
        return $this->api->changeSmallView($entityId, $imageId, $value);
    }

}
