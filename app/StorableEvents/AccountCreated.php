<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class AccountCreated extends ShouldBeStored
{
    public function __construct(public string $name){ }
}
