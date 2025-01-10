<?php

use Src\Route;

if (Route::isAPIcall()){
    require 'Routes/api.php';
    exit();
}
require 'Routes/web.php';
