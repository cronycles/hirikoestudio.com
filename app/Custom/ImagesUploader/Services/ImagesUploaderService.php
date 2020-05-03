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
     * @param int $offerId
     * @param int $imageId
     * @return bool
     */
    public function deleteImage($offerId, $imageId) {
        try {
            $outcome = false;
            if ($offerId != null && $imageId != null) {
                $outcome = $this->api->deleteImage($offerId, $imageId);
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param int $offerId
     * @param array $imagesSortedIds
     */
    public function updateImagesSort(int $offerId, array $imagesSortedIds) {
        $this->api->updateImagesSort($offerId, $imagesSortedIds);
    }

}
