<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function confirmPhone(User $user, string $code) : bool
    {
        return $code == '1234';
    }

    public function upload(UploadedFile $file)
    {
        $uuid = Str::uuid();
        $file->storeAs(public_path('files/' . $uuid . '.' . $file->extension()));

        return $uuid;
    }

}
