<?php

namespace App\External\Repositories;

use App\Custom\Api\Repositories\Repository;
use App\Locale;

class LocalesRepository extends Repository
{
    public function __construct(Locale $locale)
    {
        $this->modelClassName = $locale;
    }

    public function all()
    {
        return $this->modelClassName
            ->where('enabled', '=', true)
            ->get();
    }
}
