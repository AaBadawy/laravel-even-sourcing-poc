<?php

namespace App\Reactors;

use App\Mail\ImportantAccountNameCreated;
use App\StorableEvents\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class ImportantName extends Reactor implements ShouldQueue
{
    final const EMAIL = 'ahmedbadawy.fcai@gmail.com';

    protected static $importantNames =  [
        'ahmed',
        'foo',
        'bar',
    ];

    public function onAccountCreated(AccountCreated $event)
    {
        if(in_array(needle: $event->name,haystack: self::$importantNames)) {
            // current account name matched with the system important names
            Mail::to(static::EMAIL)->send(new ImportantAccountNameCreated(name: $event->name));
        }
    }
}
