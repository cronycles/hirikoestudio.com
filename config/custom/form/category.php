<?php

return [
    'id' => 'category_form',
    'fields' => [
        'name' => [
            'type' => 1,
            'name' => 'name',
            'textKey' => 'validation.attributes.name',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ]
    ]
];
