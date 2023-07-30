<?php

namespace App\Repositories;

use App\Models\User;
use App\DTOs\RegisterUserDTO;

class AuthRepository
{
    private User $model;

    public function __construct()
    {
        $this->model = app(User::class);
    }

    public function store(RegisterUserDTO $dto): array
    {
        $user = $this->model::create($dto->toArray());

        return create_token($user);
    }

    public function exists(string $value, string $field = 'uid'): bool
    {
        return $this->model::where($field, $value)->exists();
    }
}
