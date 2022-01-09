<?php

namespace App\Aggregates;

use App\Exceptions\AccountExceptionType;
use App\Exceptions\CantCreateAccount;
use App\Models\Account;
use App\StorableEvents\AccountCreated;
use App\StorableEvents\NameExistsBefore;
use App\StorableEvents\UserCreated;
use Illuminate\Support\Str;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class AccountAggregate extends AggregateRoot
{
    /**
     * @param string $name
     * @return $this
     * @throws \Exception
     */
    public function createAccount(string $name): static
    {
        $this->passNameUnique(name: $name);

        $this->passNameDoesntContainSpaces(name: $name);

        $this->recordThat(new AccountCreated(name: $name));

        return $this;
    }

    /**
     * @param string $name
     * @return void
     * @throws \Exception
     */
    public function createUser(string $name): static
    {
        $this->passNameUnique(name: $name);

        $this->recordThat(new UserCreated(name: $name));

        return $this;
    }

    /**
     * @param string $name
     * @return void
     * @throws \Exception
     */
    private function passNameUnique(string $name):void
    {
        if(! $this->accountNameIsUnique(name: $name)){

            $this->recordThat(new NameExistsBefore(name: $name));

            CantCreateAccount::throw(type: AccountExceptionType::nameExistsBefore);
        }
    }

    /**
     * @param string $name
     * @return void
     * @throws CantCreateAccount
     */
    private function passNameDoesntContainSpaces(string $name):void
    {
        if($this->accountContainSpaces(name: $name)){
            throw new CantCreateAccount(type: AccountExceptionType::containSpace);
        }
    }

    private function accountNameIsUnique(string $name): bool
    {
        return ! Account::query()->where('name',$name)->exists();
    }

    private function accountContainSpaces(string $name): bool
    {
        return Str::contains(haystack: $name,needles: ' ');
    }
}
