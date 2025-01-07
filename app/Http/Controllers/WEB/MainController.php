<?php

namespace App\Http\Controllers\WEB;

use JetBrains\PhpStorm\NoReturn;

class MainController {

    public function home():void {
        views( 'home');
    }

    #[NoReturn] public function login(): void
    {
        require '../resources/views/auth/login.php';
        exit();
    }

    #[NoReturn] public function register(): void
    {
        require '../resources/views/auth/register.php';
        exit();
    }

    public function about(): void
    {
        views('about');
    }
}