<?php

namespace App\Custom\ImagesUploader\Api;

use Illuminate\Http\UploadedFile;

interface IImagesUploaderApi {

    /**
     * @param int $entityId
     * @param UploadedFile $file
     * @return int|null
     */
    public function saveImage(UploadedFile $file, int $entityId);

    /**
     * @param int|null $entityId
     * @param int $imageId
     * @return bool
     */
    public function deleteImage(int $imageId, int $entityId = null);

    /**
     * @param int|null $entityId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateImagesSort(array $imagesSortedIds, int $entityId);

    /**
     * @param int $imageId
     * @param bool $value
     * @param int|null $entityId
     * @return bool
     */
    public function changeSmallView(int $imageId, bool $value, int $entityId = null);

    /**
     * @param int $imageId
     * @param bool $value
     * @param int|null $entityId
     * @return bool
     */
    public function changeIsMobileProperty(int $imageId, bool $value = true, int $entityId = null);
}
