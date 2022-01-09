<?php

namespace App\Exceptions;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

enum AccountExceptionType: string
{
    case nameExistsBefore = 'This name already exists before!';

    case containSpace = 'The user name cant contain any spaces!';

    public function message():string
    {
        return $this->value;
    }

    public function code():int
    {
        return match ($this) {
            AccountExceptionType::nameExistsBefore, AccountExceptionType::containSpace => Response::HTTP_FORBIDDEN,
        };
    }
}
