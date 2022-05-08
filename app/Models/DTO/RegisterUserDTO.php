<?php

namespace App\Models\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserDTO extends DataTransferObject
{
    public string $firstname;
    public string $lastname;
    public string $birthdate;
    public string $email;
    public string $password;

    public static function fromRequest(Request $request): self {
        return new self([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'birthdate' => $request->get('birthdate'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }
}
