<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class NameExistsBefore extends ShouldBeStored
{
    public function __construct(public string $name)
    {
    }
}
