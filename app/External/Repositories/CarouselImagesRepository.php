<?php

namespace App\External\Repositories;

use App\CarouselImage;
use App\Custom\Api\Repositories\Repository;
use App\Custom\Logging\AppLog;
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
     * @param array $sortedIds
     */
    public function updateSort(array $sortedIds) {
        try {
            DB::beginTransaction();

            for ($i = 0; $i< count($sortedIds); $i++) {
                $sortedId = $sortedIds[$i];
                $newOder = $i + 1;

                DB::table('carousel_image')
                    ->where('id', '=', $sortedId)
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
}
