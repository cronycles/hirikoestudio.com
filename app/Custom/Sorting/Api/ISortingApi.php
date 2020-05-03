<?php


namespace App\Custom\Sorting\Api;


interface ISortingApi {

    /**
     * @param array[int] $sortedIds
     */
    public function updateSort(array $sortedIds);

}
