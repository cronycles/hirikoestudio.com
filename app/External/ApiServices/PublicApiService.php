<?php

namespace App\External\ApiServices;

use App\Custom\Logging\AppLog;
use App\External\ApiServiceEntities\User;
use App\External\Repositories\UsersRepository;

class PublicApiService {

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    public function __construct(
        UsersRepository $usersRepository) {

        $this->usersRepository = $usersRepository;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId) {
        try {
            $outcome = null;

            if ($userId != null && $userId > 0) {
                /** @var \App\User $dbUser */
                $dbUser = $this->usersRepository->find($userId);
                $outcome = $this->createUserEntityByDbEntity($dbUser);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param \App\User|null $dbUser
     * @return User
     */
    private function createUserEntityByDbEntity($dbUser) {
        $outcome = new User();
        if ($dbUser != null) {
            $outcome->id = $dbUser->id;
            $outcome->name = $dbUser->name;
            $outcome->email = $dbUser->email;
        }
        return $outcome;
    }
}
