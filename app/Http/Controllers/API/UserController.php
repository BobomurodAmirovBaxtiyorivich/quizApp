<?php

namespace App\Http\Controllers\API;

use App\Models\User;use App\Traits\Validator;use JetBrains\PhpStorm\NoReturn;use Random\RandomException;
class UserController
{
    use Validator;
    /**
* @throws RandomException
*/
    #[NoReturn]public function register():void {
        $this->validate(
            ['full_name' => 'string',
            'email' => 'string',
            'password' => 'string'
            ]);
        $user = new User();
        $user->create($_POST['full_name'], $_POST['email'], $_POST['password']);
        APIresponse([
            'message' => 'User created successfully',
            'token' => $user->ApiToken
            ], 201);
    }

    /**
* @throws RandomException
*/#[NoReturn]public function login():void {
        $this->validate([
            'email' => 'string',
            'password' => 'string'
        ]);

        $user = new User();
        if ($user->getUser($_POST['email'], $_POST['password'])) {
            APIresponse([
                'message' => 'User logged in successfully',
                'token' => $user->ApiToken
                ]);
        }
    }
}