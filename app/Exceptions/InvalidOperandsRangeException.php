<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidOperandsRangeException extends Exception
{
    public function __construct(
        string $message = "As parcelas devem ser numeros entre 0 e 999", int $code = 0, ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
