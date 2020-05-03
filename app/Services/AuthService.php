<?php

namespace App\Services;

use App\Api\UsersApi;
use App\Entities\UserEntity;
use Illuminate\Support\Facades\Auth;

class AuthService {

    /**
     * @var UsersApi
     */
    private $api;

    public function __construct(UsersApi $api) {
        $this->api = $api;
    }

    /**
     * @return UserEntity|null
     */
    public function getAuthUser() {
        $outcome = null;
        if($this->isAnyUserAuthenticated()) {
            $outcome = $this->api->getUserById(Auth::user()->id);
        }
        return $outcome;
    }

    /**
     * @return bool
     */
    public function isAnyUserAuthenticated() {
        return Auth::check();
    }

}
