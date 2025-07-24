<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\Auth\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}

    public function register(RegisterRequest $request)
    {
        return response()->json($this->authRepository->register($request));
    }

    public function login(LoginRequest $request)
    {
        return response()->json($this->authRepository->login($request));
    }

    public function logout(Request $request)
    {
        return response()->json($this->authRepository->logout($request));
    }

    public function me(Request $request)
    {
        return response()->json($this->authRepository->me($request));
    }
}
