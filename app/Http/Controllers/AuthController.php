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
    public function register(RegisterRequest $request, RegisterAction $registerAction): JsonResponse
    {
        try {
            $user = $registerAction->execute($request->validated());
            return response_api('Dados cadastrados com sucesso', $user, 201);

        } catch (\Exception $e) {
            send_log('Erro ao cadastrar usuário', [], 'error', $e);
            return response_api(
                'Erro ao cadastrar usuário',
                [],
                $e->getCode()
            );
        }
    }

    public function login(LoginRequest $request, LoginAction $loginAction): JsonResponse
    {
        $user = $loginAction->execute($request->validated());
        return response_api('Dados retornados com sucesso', $user, 200);
    }

    public function me(Request $request): JsonResponse
    {
        $this->authorize('view-user-configuration');
        try {
            $user = $request->user();

            $user->loadMissing('roles');

            return response_api('Dados retornados com sucesso', $user->toArray(), 200);

        } catch (\Exception $e) {
            send_log('Erro ao logar usuário', [], 'error', $e);
            return response_api(
                'Erro ao logar usuário',
                [],
                $e->getCode() == 0 ? 500 : $e->getCode()
            );
        }
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
                $e->getCode()
            );
        }
    }

    // TODO: Faltar Implementar Update User
    // TODO: Faltar Implementar Delete User
    // TODO: Faltar Implementar Forgot Password
    // TODO: Faltar Implementar Reset Password
}
