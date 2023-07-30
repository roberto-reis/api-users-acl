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

    public function logout(): JsonResponse
    {
        try {
            Auth::user()->currentAccessToken()->delete();
            return response_api('Logout feito com sucesso', [], 200);

        } catch (\Exception $e) {
            send_log('Erro ao deslogar usuário', [], 'error', $e);
            return response_api(
                'Erro ao deslogar usuário',
                [],
                $e->getCode() == 0 ? 500 : $e->getCode()
            );
        }
    }

}
