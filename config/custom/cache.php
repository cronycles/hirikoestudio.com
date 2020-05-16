<?php

return [

    'isEnabled' => env('CACHE_ENABLED'),

    'api' => [
        'users' => ['key' => 'users', 'seconds' => 60],
        'languages' => ['key' => 'languages', 'seconds' => 60],
        'categories' => ['key' => 'categories', 'seconds' => 60],
        'projects' => ['key' => 'projects', 'seconds' => 60],
    ]
];
