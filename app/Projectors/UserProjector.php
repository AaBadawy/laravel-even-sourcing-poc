<?php

namespace App\Projectors;

use App\Models\User;
use App\StorableEvents\UserCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class UserProjector extends Projector
{
    public function onUserCreated(UserCreated $event)
    {
        //TODO CHECK USING CONDITION IS CORRECT OR NO
        User::firstOrCreate(['email' => $event->email],['name' => $event->name,'email' => $event->email,'password' => $event->password]);
    }
}
