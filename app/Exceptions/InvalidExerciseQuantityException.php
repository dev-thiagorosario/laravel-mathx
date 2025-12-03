<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidExerciseQuantityException extends Exception
{
    public function __construct(
        string $message = "O numero de exercicios deve ser entre 5 e 50", int $code = 0, ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
