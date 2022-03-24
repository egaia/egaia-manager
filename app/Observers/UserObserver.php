<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user) {
        $user->api_token = Str::random(80);
        $user->email_verify_token = Str::random(80);
    }
}
