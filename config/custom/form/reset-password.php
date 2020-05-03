<?php

return [
    'id' => 'reset_password_form',
    'fields' => [
        'token' => [
            'type' => 11,
            'name' => 'token',
            'textKey' => '',
            'errorTextKey' => '',
            'validations' => [],
        ],
        'email' => [
            'type' => 4,
            'name' => 'email',
            'textKey' => 'validation.attributes.email',
            'errorTextKey' => '{"id": "validation-js.email", "params": {}}',
            'validations' => ['required', 'email'],
        ],
        'password' => [
            'type' => 5,
            'name' => 'password',
            'textKey' => 'validation.attributes.password',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ],
        'password-confirm' => [
            'type' => 5,
            'name' => 'password_confirmation',
            'textKey' => 'validation.attributes.password_confirm',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ],
    ]
];
