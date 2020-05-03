<?php

return [
    'siteVerify' => 'https://www.google.com/recaptcha/api/siteverify',
    'key' => env('RECAPTCHA_KEY'),
    'secret' => env('RECAPTCHA_SECRET_KEY'),
    'field' => 'captcha'
];