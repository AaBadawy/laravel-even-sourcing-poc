<?php

namespace App\Exceptions;

use Exception;


class CantCreateAccount extends Exception
{
    /**
     * @param AccountExceptionType $type
     * @return static
     */
    public static function throw(AccountExceptionType $type): static
    {
        return new static(message: $type->message(),code: $type->code());
    }

}
