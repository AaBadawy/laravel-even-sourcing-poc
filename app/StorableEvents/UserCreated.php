<?php

namespace App\StorableEvents;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UserCreated extends ShouldBeStored
{
    public string $email;

    public string $password;

    public function __construct(public string $name)
    {
        $this->generateEmail();
        $this->generatePassword();
    }

    private function generateEmail(): void
    {
        $this->email = Str::snake($this->name) . "@joovlly.com";
    }

    private function generatePassword(): void
    {
        $this->password = Hash::make($this->name);
    }
}
