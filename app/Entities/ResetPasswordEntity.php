<?php

namespace App\Entities;

use App\Custom\Entities\CustomEntity;

class ResetPasswordEntity extends CustomEntity {

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    public function __construct() {
    }

}
