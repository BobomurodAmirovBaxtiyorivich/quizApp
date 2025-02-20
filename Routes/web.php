<?php

use Src\Route;
use App\Http\Controllers\WEB\MainController;
use App\Http\Controllers\WEB\UserController;

Route::getMethod('/', [MainController::class, 'home']);

Route::getMethod('/dash', [MainController::class, 'home']);

Route::getMethod('/about', [MainController::class, 'about']);

Route::getMethod('/login', [MainController::class, 'login']);

Route::getMethod('/register', [MainController::class, 'register']);

Route::getMethod('/dashboard', [UserController::class, 'home']);


Route::NotFound();