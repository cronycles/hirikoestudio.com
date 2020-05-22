<?php

namespace App\Custom\Slug\Controllers;

use App\Custom\Logging\AppLog;
use App\Http\Controllers\Controller;

abstract class SlugController extends Controller {

    protected function getIdFromSlug($slug) {
        try {
            $outcome = 0;
            $matches = [];
            preg_match('/([^-]*)$/', $slug, $matches);

            $idWithText = $matches[1];

            $id = str_replace("id", "", $idWithText);

            if(!is_int($id)) {
                $outcome = $id;
            }

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return 0;
        }

    }

}
