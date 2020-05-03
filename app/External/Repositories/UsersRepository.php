<?php

namespace App\External\Repositories;

use App\Custom\Api\Repositories\Repository;
use App\User;

class UsersRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->modelClassName = $user;
    }

}
