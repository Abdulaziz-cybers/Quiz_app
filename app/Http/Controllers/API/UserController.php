<?php
namespace App\Http\Controllers\API;

use App\Models\User;
use App\Traits\Validator;
use JetBrains\PhpStorm\NoReturn;
use Random\RandomException;
use Src\Auth;

class UserController
{
    use Validator;

    /**
     * @throws RandomException
     */
    #[NoReturn] public function store(): void {
        $userData = $this->validate([
            'full_name' => 'string',
            'email' => 'string',
            'password' => 'string',
            'password_confirm' => 'string'
        ]);
        $user = new User();
        $user->create($userData['full_name'], $userData['email'], $userData['password']);
        apiResponse(['message' => 'User created','token' => $user->apiToken],201);
    }
    #[NoReturn] public function login(): void {
        $userData = $this->validate([
            'email' => 'string',
            'password' => 'string',
        ]);
        $user = new User();
        $user->getUser($userData['email'], $userData['password']);
        apiResponse(['message' => 'User logged in', 'token' => $user->apiToken]);
    }
    #[NoReturn] public function show(): void
    {
        $user = Auth::user();
        apiResponse([
            'message' => 'User information',
            'data' => $user
        ]);
    }

}