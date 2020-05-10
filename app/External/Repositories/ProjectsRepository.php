<?php

namespace App\External\Repositories;

use App\Custom\Api\Repositories\Repository;
use App\Custom\Logging\AppLog;
use App\Image;
use App\Project;
use Illuminate\Support\Facades\DB;

class ProjectsRepository extends Repository {
    public function __construct(Project $project) {
        $this->modelClassName = $project;
    }

    public function all() {
        return $this->modelClassName
            ->orderByRaw('ISNULL(order_number), order_number asc')
            ->get();
    }

    /**
     * @param Image $dbImageEntity
     * @param int $projectId
     * @return int
     */
    public function saveImageToProject(Image $dbImageEntity, int $projectId) {
        try {
            $outcome = 0;
            /** @var Project $dbProject */
            $dbProject = $this->find($projectId);
            DB::beginTransaction();
            $isImageSaved = $dbImageEntity->save();
            if ($isImageSaved && $dbImageEntity->id > 0) {
                $dbProject->images()->attach($dbImageEntity->id);
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
    public function updateSort(array $sortedIds) {
        try {
            DB::beginTransaction();

            for ($i = 0; $i< count($sortedIds); $i++) {
                $sortedId = $sortedIds[$i];
                $newOder = $i + 1;

                DB::table('projects')
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

    /**
     * @param int $projectId
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateImagesSort(int $projectId, array $imagesSortedIds) {
        try {
            DB::beginTransaction();

            for ($i = 0; $i< count($imagesSortedIds); $i++) {
                $sortedId = $imagesSortedIds[$i];
                $newOder = $i + 1;

                DB::table('image_project')
                    ->where('project_id', '=', $projectId)
                    ->where('image_id', '=', $sortedId)
                    ->update([
                        'image_order' => $newOder
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
     * @param int $projectId
     * @param int $imageId
     * @param bool $value
     * @return bool
     */
    public function changeProjectImageSmallView(int $projectId, int $imageId, bool $value = true) {
        try {
            DB::beginTransaction();

                DB::table('image_project')
                    ->where('project_id', '=', $projectId)
                    ->where('image_id', '=', $imageId)
                    ->update([
                        'image_small_view' => $value
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
