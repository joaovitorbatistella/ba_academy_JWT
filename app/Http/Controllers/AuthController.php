<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;

class AuthController extends Controller
{

    /**
     * @var App\Services\AuthService
     */
    private $auth_service;

    /**
     * Constructor
     * @param $auth_service dependency injection
     */
    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    public function register(AuthRegisterRequest $request)
    {
        $input = $request->validated();
        $user = $this->auth_service->register(
            $input['first_name'],
            $input['last_name'] ?? '',
            $input['email'],
            $input['password'],
        );
        return new UserResource($user);
    }

    public function login(AuthLoginRequest $request)
    {
        $input = $request->validated();
        $token = $this->auth_service->login(
            $input['email'],
            $input['password'],
        );
        return (new UserResource(auth()->user()))->additional($token);
    }

    public function me()
    {
        return new UserResource(auth()->user());
    }

    public function refresh()
    {
        $token = $this->auth_service->refresh();
        return (new UserResource(auth()->user()))->additional($token);
    }

    public function logout()
    {
        auth()->logout(true);
        return response()->json(['success' => true]);
    }

    public function invalidate()
    {
        $success = auth()->invalidate(true);
        return response()->json(['success' => $success]);
    }
}
