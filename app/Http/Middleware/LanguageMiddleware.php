<?php

namespace App\Http\Middleware;

use App\Custom\Languages\Middleware\LanguageMiddlewareTrait;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class LanguageMiddleware extends Middleware{
    use LanguageMiddlewareTrait;
}
