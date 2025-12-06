<?php

namespace App\Exceptions;

use Exception;

class EmailAlreadyExistsException extends Exception
{
    public function __construct(string $message = 'Email já cadastrado.', int $code = 400) {
        parent::__construct($message, $code);
    } 
}
