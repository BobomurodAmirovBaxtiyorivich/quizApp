<?php

use Src\Route;
use App\Http\Controllers\WEB\MainController;

Route::getMethod('/', [MainController::class, 'home']);

Route::getMethod('/dash', [MainController::class, 'home']);

Route::getMethod('/about', [MainController::class, 'about']);

Route::getMethod('/login', [MainController::class, 'login']);

Route::getMethod('/register', [MainController::class, 'register']);