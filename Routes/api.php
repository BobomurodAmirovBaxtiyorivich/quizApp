<?php

use App\Http\Controllers\API\QuizController;use App\Http\Controllers\API\UserController;use Src\Route;
use App\Http\Controllers\WEB\MainController;

Route::getMethod('/api/user/{id}', [UserController::class, 'show'], 'auth:api');

Route::postMethod('/api/register', [UserController::class, 'register']);

Route::postMethod('/api/login', [UserController::class, 'login']);

Route::postMethod('/api/quizzes', [QuizController::class, 'create']);

Route::NotFound();