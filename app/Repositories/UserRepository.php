<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function findOrFail($id) : User
    {
        return User::findOrFail($id);
    }

    public function update(User $user, array $data) : bool
    {
        return $user->update($data);
    }

}
