<?php

namespace App\Exceptions;

use Exception;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;


class CantCreateAccount extends Exception
{
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
