<?php

namespace App\Custom\ImagesUploader\Services;

use App\Custom\ImagesUploader\Api\IImagesUploaderApi;
use App\Custom\Logging\AppLog;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class ImagesUploaderService {

    /**
     * @var IImagesUploaderApi
     */
    protected $api;

    public function __construct(IImagesUploaderApi $api) {
        $this->api = $api;
    }

    public function saveImage(UploadedFile $file, int $id = null) {
        try {
            $outcome = null;

            $savedImageId = $this->api->saveImage($file, $id);

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
     * @param int $imageId
     * @param int|null $entityId
     * @return bool
     */
    public function deleteImage(int $imageId, int $entityId = null) {
        try {
            $outcome = false;
            if ($imageId != null) {
                $outcome = $this->api->deleteImage($imageId, $entityId);
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param array $imagesSortedIds
     * @param int|null $entityId
     */
    public function updateImagesSort(array $imagesSortedIds, int $entityId = null) {
        return $this->api->updateImagesSort($imagesSortedIds, $entityId);
    }

    /**
     * @param int $imageId
     * @param int|null $entityId
     * @param bool $value
     */
    public function changeSmallView(int $imageId, int $entityId = null, bool $value = true) {
        return $this->api->changeSmallView($imageId, $value, $entityId);
    }

    /**
     * @param int $imageId
     * @param int|null $entityId
     * @param bool $value
     */
    public function changeIsMobileProperty(int $imageId, int $entityId = null, bool $value = true) {
        return $this->api->changeIsMobileProperty($imageId, $value, $entityId);
    }

}
