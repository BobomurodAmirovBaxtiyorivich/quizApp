<?php

namespace Src\middlewares;

use Src\Auth;
use Src\middlewares\Middleware;
class AuthMiddleware implements Middleware
{

    public function handle(): void
    {
        Auth::check();
    }
}