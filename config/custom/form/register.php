<?php

return [
    'id' => 'register_form',
    'fields' => [
        'name' => [
            'type' => 1,
            'name' => 'name',
            'textKey' => 'validation.attributes.name',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
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
