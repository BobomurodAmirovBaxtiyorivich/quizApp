<?php

use Src\middlewares\AuthMiddleware;

return [
    "auth:api" => AuthMiddleware::class,
    "auth:web" => AuthMiddleware::class,
];