<?php

namespace App\External\Repositories;

use App\CarouselImage;
use App\Custom\Api\Repositories\Repository;
use App\Custom\Logging\AppLog;
use App\Image;
use Illuminate\Support\Facades\DB;

class CarouselImagesRepository extends Repository {
    public function __construct(CarouselImage $dbModel) {
        $this->modelClassName = $dbModel;
    }

    public function all() {
        return $this->modelClassName
            ->orderByRaw('ISNULL(order_number), order_number asc')
            ->get();
    }

    /**
     * @param CarouselImage $carouselImage
     * @param Image $dbImageEntity
     * @return int
     */
    public function saveHomeSlide(CarouselImage $carouselImage, Image $dbImageEntity) {
        try {
            $outcome = 0;
            DB::beginTransaction();
            $isImageSaved = $dbImageEntity->save();
            if ($isImageSaved && $dbImageEntity->id > 0) {
                $carouselImage->image_id = $dbImageEntity->id;
                $carouselImage->save();
                DB::commit();
                $outcome = $dbImageEntity->id;
            } else {
                DB::rollBack();
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return 0;
        }
    }

    /**
     * @param array $sortedIds
     */
    public function updateImagesSort(array $sortedIds) {
        try {
            DB::beginTransaction();

            for ($i = 0; $i< count($sortedIds); $i++) {
                $sortedId = $sortedIds[$i];
                $newOder = $i + 1;

                DB::table('carousel_images')
                    ->where('image_id', '=', $sortedId)
                    ->update([
                        'order_number' => $newOder
                    ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param int $imageId
     * @param bool $value
     * @return bool
     */
    public function changeHomeSlidesIsMobileProperty(int $imageId, bool $value = true) {
        try {
            DB::beginTransaction();

            DB::table('carousel_images')
                ->where('image_id', '=', $imageId)
                ->update([
                    'is_mobile' => $value
                ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return false;
        }
    }
}
