<?php

namespace App\Custom\Sorting\Services;

use App\Custom\Sorting\Api\ISortingApi;

abstract class SortingService {

    /**
     * @var ISortingApi
     */
    private $api;

    public function __construct(ISortingApi $api) {
        $this->api = $api;
    }

    /**
     * @param array[int] $sortedIds
     */
    public function updateSort(array $sortedIds) {
        $this->api->updateSort($sortedIds);
    }
}
