<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class NoOperationSelectedException extends Exception
{
    public function __construct(
        string $message = "Por favor selecione pelo menos uma operação", int $code = 0, ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
