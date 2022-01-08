<?php

namespace App\Projectors;

use App\Models\Account;
use App\StorableEvents\AccountCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class AccountProjector extends Projector
{
    public function onAccountCreated(AccountCreated $accountCreatedEvent)
    {
        Account::create(['name' => $accountCreatedEvent->name]);
    }
}
