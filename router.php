<?php

use Src\Route;

if (Route::isAPIcall()){
    require 'Routes/api.php';
    exit();
} else {
    require 'Routes/web.php';
}
