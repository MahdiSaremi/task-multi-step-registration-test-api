<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name' => 'nullable|string',
            'age' => 'nullable|integer|min:5|max:200',
            'phone' => ['nullable', 'string', 'regex:/^(\+?98|0)?\d{11}$/'],
            'image' => 'nullable|string',
        ]);

        return response()->json(
            $this->userService->update($user, $data)
        );
    }

    public function verify(Request $request)
    {
        $id = $request->validate(['id' => 'required|int'])['id'];
        $user = $this->userRepository->findOrFail($id);

        switch ($request->get('method'))
        {
            case 'confirmPhone':
                $data = $request->validate([
                    'code' => 'required|string',
                ]);

                return response()->json(
                    $this->userService->confirmPhone($user, $data['code'])
                );

            default:
                abort(404);
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');

        return response()->json($this->userService->upload($file));
    }

}
