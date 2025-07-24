<?php

namespace App\Interfaces\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function register(RegisterRequest $request): array;

    public function login(LoginRequest $request): array;

    public function logout(Request $request): array;

    public function me(Request $request): array;
}
