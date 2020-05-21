<?php

return [
    'id' => 'category_form',
    'fields' => [
        'category' => [
            'type' => 10,
            'name' => 'category',
            'textKey' => 'validation.attributes.category',
            'zeroValueKey' => 'validation.attributes.zeroValueKey',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ],
        'title' => [
            'type' => 1,
            'name' => 'title',
            'textKey' => 'validation.attributes.title',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ],
        'description' => [
            'type' => 2,
            'translatable' => true,
            'name' => 'description',
            'textKey' => 'validation.attributes.description',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ],
        'show' => [
            'type' => 6,
            'name' => 'show',
            'default' => true,
            'textKey' => 'validation.attributes.show',
            'errorTextKey' => '{"id": "validation-js.required", "params": {}}',
            'validations' => ['required'],
        ]
    ]
];
