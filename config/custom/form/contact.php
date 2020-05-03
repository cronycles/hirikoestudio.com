<?php

return [
    'id' => 'contact_form',
    'withCaptcha' => true,
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

        'message' => [
            'type' => 3,
            'name' => 'textMsg',
            'rows' => '4',
            'textKey' => 'validation.attributes.textMsg',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ]
    ]
];
