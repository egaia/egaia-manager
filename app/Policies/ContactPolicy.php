<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Contact $contact)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return false;
    }

    public function update(Admin $admin, Contact $contact)
    {
        return true;
    }

    public function delete(Admin $admin, Contact $contact)
    {
        return true;
    }

    public function restore(Admin $admin, Contact $contact)
    {
        return true;
    }

    public function forceDelete(Admin $admin, Contact $contact)
    {
        return true;
    }
}
