<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialException extends Exception
{

    public function __construct(string $message = 'Credenciais inválidas.', int $code = 401)
    {
        parent::__construct($message, $code);
    }
}
