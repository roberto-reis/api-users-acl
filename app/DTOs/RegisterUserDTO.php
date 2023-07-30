<?php

namespace App\DTOs;

use Illuminate\Support\Facades\Hash;

class RegisterUserDto extends DataTransferObject
{
    public ?string $first_name;
    public ?string $last_name;
    public ?string $phone;
    public ?string $email;
    public ?string $password;

    public function withMakeHash(): self
    {
        if (is_null($this->password)) throw new \Exception("Password não pode ser null", 400);

        $this->password = Hash::make($this->password);

        return $this;
    }

}
