<?php

namespace App\Repositories\User;

use App\Models\DTO\RegisterUserDTO;
use App\Models\DTO\UpdateUserDTO;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected string $model = User::class;

    public function find(int $id): ?User
    {
        return $this->query()
            ->where('id', $id)
            ->first();
    }

    public function findOrFailByEmail(string $email): User
    {
        return $this->query()
            ->where('email', $email)
            ->firstOrFail();
    }


    public function store(RegisterUserDTO $registerUserDTO): User
    {
        $user = new User();
        $user->setAttribute('firstname', $registerUserDTO->firstname);
        $user->setAttribute('lastname', $registerUserDTO->lastname);
        $user->setAttribute('birthdate', $registerUserDTO->birthdate);
        $user->setAttribute('email', $registerUserDTO->email);
        $user->setAttribute('password', Hash::make($registerUserDTO->password));
        $user->setAttribute('points', 0);
        $user->saveOrFail();

        return $user;
    }

    public function update(User $user, UpdateUserDTO $updateUserDTO): User
    {
        if($updateUserDTO->firstname != null) $user->setAttribute('firstname', $updateUserDTO->firstname);
        if($updateUserDTO->lastname != null) $user->setAttribute('lastname', $updateUserDTO->lastname);
        if($updateUserDTO->birthdate != null) $user->setAttribute('birthdate', $updateUserDTO->birthdate);
        if($updateUserDTO->image != null) $user->setAttribute('image', explode('/', $updateUserDTO->image)[1]);
        if($updateUserDTO->email != null) $user->setAttribute('email', $updateUserDTO->email);
        if($updateUserDTO->password != null) $user->setAttribute('password', Hash::make($updateUserDTO->password));
        $user->saveOrFail();

        return $user;
    }
}
