<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;


class UserController extends Controller
{
    public function create(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $user = new User();
        $user->name = $data['name'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return response()->json(['message' => 'user created successfully'], 201);
    }
}
