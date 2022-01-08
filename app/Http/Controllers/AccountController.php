<?php

namespace App\Http\Controllers;

use App\Aggregates\AccountAggregate;
use App\Models\Account;
use App\StorableEvents\AccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $newUuid = Str::uuid();

        $name = $request->query('name');

        AccountAggregate::retrieve($newUuid)
            ->createUser(name: $name)
            ->createAccount(name: $name)
            ->persist();
        return "Done";
    }
}
