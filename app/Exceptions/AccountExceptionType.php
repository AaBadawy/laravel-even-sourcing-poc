<?php

namespace App\Exceptions;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

enum AccountExceptionType
{
    case nameExists;

    case containSpace;

    public function message():string
    {
        return match ($this) {
            AccountExceptionType::nameExists    => 'This name already exists before!',

            AccountExceptionType::containSpace  => 'The user name cant contain any spaces!',
        };
    }

    public function code():int
    {
        return match ($this) {
            AccountExceptionType::nameExists, AccountExceptionType::containSpace => Response::HTTP_FORBIDDEN,
        };
    }
}
