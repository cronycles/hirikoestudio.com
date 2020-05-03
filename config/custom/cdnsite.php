<?php

return [
    'url' => env('LOCAL_CDN') ?  '/' . env('CDN_NAME') : 'https://' . env('CDN_NAME'),
    'path' => env('LOCAL_CDN') ?  public_path(). "/" . env('CDN_NAME') : base_path(). "/" . env('CDN_NAME'),
];
