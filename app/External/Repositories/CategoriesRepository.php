<?php

namespace App\External\Repositories;

use App\Category;
use App\Custom\Api\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class CategoriesRepository extends Repository
{
    public function __construct(Category $productCategory)
    {
        $this->modelClassName = $productCategory;
    }

    public function all()
    {
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

                DB::table('categories')
                    ->where('id', '=', $sortedId)
                    ->update([
                        'order_number' => $newOder
                    ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
