<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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


    protected function findUser(Request $request) : User
    {
        $id = $request->validate(['id' => 'required|int'])['id'];

        return User::findOrFail($id);
    }

}
