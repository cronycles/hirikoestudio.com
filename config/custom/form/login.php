<?php

return [
    'id' => 'login_form',
    'fields' => [
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
        'checkbox' => [
            'type' => 6,
            'name' => 'remember',
            'textKey' => 'validation.attributes.remember',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ]
    ]
];
