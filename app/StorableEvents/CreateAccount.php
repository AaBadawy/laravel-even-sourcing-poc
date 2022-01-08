<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CreateAccount extends ShouldBeStored
{
    public function __construct()
    {
    }
}
