<?php

namespace App\Actions;

use App\DTOs\RegisterUserDTO;
use App\Repositories\AuthRepository;

class RegisterAction
{
    public function __construct(
        private AuthRepository $userRepository
    )
    {}

    public function execute(array $data): array
    {
        $userDTO = new RegisterUserDTO($data);

        return $this->userRepository->store($userDTO->withMakeHash());
    }
}
