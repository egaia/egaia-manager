<?php

namespace App\Repositories\User;

use App\Models\DTO\RegisterUserDTO;
use App\Models\User;

interface UserRepository
{
    public function find(int $id): ?User;

    public function findOrFailByEmail(string $email): User;

    public function store(RegisterUserDTO $registerUserDTO): User;
}
