<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(
        protected UserRepository $userRepository,
        protected UserService $userService,
    )
    {
    }

    public function getUser(Request $request)
    {
        $id = $request->validate(['id' => 'required|int'])['id'];

        return $this->userRepository->findOrFail($id);
    }

    public function update(Request $request)
    {
        $id = $request->validate(['id' => 'required|int'])['id'];
        $user = $this->userRepository->findOrFail($id);

        $data = $request->validate([
            'email' => 'nullable|string|email',
            'phone' => ['nullable', 'string', 'regex:/^(+?98|0)?\d{11}$/'],
            'password' => 'nullable|string|min:8',
            'name' => 'nullable|string|min:2|max:50',
            'address' => 'nullable|string|max:150',
        ]);

        return response()->json(
            $this->userService->update($user, $data)
        );
    }

    public function verify(Request $request)
    {
        $id = $request->validate(['id' => 'required|int'])['id'];
        $user = $this->userRepository->findOrFail($id);

        // Nothing to do here

        return response()->json(true);
    }

}
