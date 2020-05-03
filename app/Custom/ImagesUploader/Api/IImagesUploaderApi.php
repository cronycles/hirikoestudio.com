<?php

namespace App\Custom\ImagesUploader\Api;

use Illuminate\Http\UploadedFile;

interface IImagesUploaderApi {

    /**
     * @param int $entityId
     * @param UploadedFile $file
     * @return int|null
     */
    public function saveImage(int $entityId, UploadedFile $file);

    /**
     * @param int $entityId
     * @param int $imageId
     * @return bool
     */
    public function deleteImage(int $entityId, int $imageId);

    /**
     * @param int $entityId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateImagesSort(int $entityId, array $imagesSortedIds);

}
