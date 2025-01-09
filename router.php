<?php

use Src\Route;
use App\Controller;

Route::getMethod("/", [Controller::class, "home"]);
