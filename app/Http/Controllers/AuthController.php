<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $register)
    {
        dd($register);
    }

    public function login(AuthLoginRequest $login)
    {
        dd($login);
    }
}
