<?php

return [

    'isEnabled' => env('CACHE_ENABLED'),

    'api' => [
        'users' => ['key' => 'users', 'seconds' => 86400],
        'languages' => ['key' => 'languages', 'seconds' => 86400],
        'categories' => ['key' => 'categories', 'seconds' => 86400],
        'slides' => ['key' => 'slides', 'seconds' => 86400],
        'projects' => ['key' => 'projects', 'seconds' => 86400],
    ]
];
