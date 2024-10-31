<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function __construct(
        protected UserRepository $userRepository,
    )
    {
    }

    public function update(User $user, array $data) : bool
    {
        if (isset($data['password']))
        {
            $data['password'] = Hash::make($data['password']);
        }

        return $user->update($data);
    }

}
