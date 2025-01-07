<?php

use App\Http\Controllers\API\QuizController;use App\Http\Controllers\API\UserController;use Src\Route;

//Auth

Route::postMethod('/api/register', [UserController::class, 'register']);

Route::postMethod('/api/login', [UserController::class, 'login']);


//Quiz

Route::postMethod('/api/quizzes', [QuizController::class, 'create']);