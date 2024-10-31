<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getUser(Request $request)
    {
        return $this->findUser($request);
    }

    public function updateEmailPhone(Request $request)
    {
        $user = $this->findUser($request);

        $data = $request->validate([
            'email' => 'required|string|email',
            'phone' => ['required', 'string', 'regex:/^(+?98|0)?\d{11}$/'],
        ]);

        $user->update($data);

        return response()->json(true);
    }

    public function updatePassword(Request $request)
    {
        $user = $this->findUser($request);

        $data = $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return response()->json(true);
    }

    public function updatePersonalInfo(Request $request)
    {
        $user = $this->findUser($request);

        $data = $request->validate([
            'name' => 'required|string|min:2|max:50',
            'address' => 'required|string|max:150',
        ]);

        $user->update($data);

        return response()->json(true);
    }


    protected function findUser(Request $request) : User
    {
        $id = $request->validate(['id' => 'required|int'])['id'];

        return User::findOrFail($id);
    }

}
