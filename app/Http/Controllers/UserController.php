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

    public function update(Request $request)
    {
        $user = $this->findUser($request);

        $data = $request->validate([
            'email' => 'nullable|string|email',
            'phone' => ['nullable', 'string', 'regex:/^(+?98|0)?\d{11}$/'],
            'password' => 'nullable|string|min:8',
            'name' => 'nullable|string|min:2|max:50',
            'address' => 'nullable|string|max:150',
        ]);

        if (isset($data['password']))
        {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json(true);
    }

    public function finish(Request $request)
    {
        $user = $this->findUser($request);

        // Nothing to do here

        return response()->json(true);
    }


    protected function findUser(Request $request) : User
    {
        $id = $request->validate(['id' => 'required|int'])['id'];

        return User::findOrFail($id);
    }

}
