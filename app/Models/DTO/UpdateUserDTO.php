<?php

namespace App\Models\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Symfony\Component\HttpFoundation\Request;

class UpdateUserDTO extends DataTransferObject
{
    public ?string $firstname;
    public ?string $lastname;
    public ?string $birthdate;
    public ?string $image;
    public ?string $email;
    public ?string $password;

    public static function fromRequest(Request $request, ?string $path): self {
        return new self([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'birthdate' => $request->get('birthdate'),
            'image' => $path,
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }
}
