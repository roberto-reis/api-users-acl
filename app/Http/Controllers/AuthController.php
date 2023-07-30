<?php

namespace App\Http\Controllers;

use App\Actions\LoginAction;
use Illuminate\Http\Request;
use App\Actions\RegisterAction;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    public function login(LoginRequest $request, LoginAction $loginAction): JsonResponse
    {
        $user = $loginAction->execute($request->validated());
        return response_api('Dados retornados com sucesso', $user, 200);
    }


}
