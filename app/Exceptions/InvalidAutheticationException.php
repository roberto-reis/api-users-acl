<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidAutheticationException extends Exception
{
    protected $message = 'Credentials don\'t match';
    protected $code = 400;

    /**
     * Report the exception.
     */
    public function report(): void
    {
        // send_log('Erro ao logar usuário', [], 'error', $this);
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(): JsonResponse
    {
        return response_api(
            $this->getMessage(),
            [],
            $this->code
        );
    }
}
