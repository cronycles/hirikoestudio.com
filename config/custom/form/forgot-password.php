<?php

return [
    'id' => 'forgot_password_form',
    'fields' => [
        'email' => [
            'type' => 4,
            'name' => 'email',
            'textKey' => 'validation.attributes.email',
            'errorTextKey' => '{"id": "validation-js.email", "params": {}}',
            'validations' => ['required', 'email'],
        ]
    ]
];
