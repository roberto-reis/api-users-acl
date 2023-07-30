<?php

namespace App\Actions;

use App\Exceptions\InvalidAutheticationException;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function execute(array $credentials): array
    {

        if (!Auth::attempt($credentials)) {
            throw new InvalidAutheticationException();
        }

        return create_token(Auth::user());
    }
}
