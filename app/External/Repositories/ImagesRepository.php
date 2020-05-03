<?php
namespace App\External\Repositories;

use App\Custom\Api\Repositories\Repository;
use App\Image;

class ImagesRepository extends Repository
{
    public function __construct(Image $image)
    {
        $this->modelClassName = $image;
    }

}
