<?php

namespace App\Exceptions;

use Exception;


class CantCreateAccount extends Exception
{
    /**
     * @param AccountExceptionType $type
     */
    public function __construct(AccountExceptionType $type)
    {
        parent::__construct(message: $type->message(), code: $type->code());
    }

    /**
     * @param AccountExceptionType $type
     * @return static
     * @throws CantCreateAccount
     */
    public static function throw(AccountExceptionType $type): static
    {
        throw new static($type);
    }

}
