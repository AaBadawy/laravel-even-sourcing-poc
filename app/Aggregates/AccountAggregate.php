<?php

namespace App\Aggregates;

use App\Models\Account;
use App\StorableEvents\AccountCreated;
use App\StorableEvents\NameExistsBefore;
use App\StorableEvents\UserCreated;
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
    private function passNameUnique(string $name): void
    {
        if(! $this->accountNameIsUnique(name: $name)){

            $this->recordThat(new NameExistsBefore(name: $name));

            throw new \Exception('this name is already exists before, Please Choose another name!',301);
        }
    }
    private function accountNameIsUnique(string $name): bool
    {
        return ! Account::query()->where('name',$name)->exists();
    }
}
