<?php


namespace App\Services;


use App\Entities\UserEntity;
use App\External\ApiServiceEntities\User;

class MappingService {

    public function __construct() {
    }

    /**
     * @param User
     * @return UserEntity
     */
    public function mapUser(User $serviceUser) {
        $outcome = null;
        if ($serviceUser != null) {
            $outcome = new UserEntity();
            $outcome->id = $serviceUser->id;
            $outcome->name = $serviceUser->name;
            $outcome->email = $serviceUser->email;
        }
        return $outcome;
    }

}
