<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        // Загружаем пользователей с их ролями
        $users = User::with('role')->get();
        return response()->json($users); // Возвращаем JSON-ответ
    }

    public function getUser(Request $request)
    {
        // return response()->json($request->user()); // работает
        $user = $request->user();
        return response()->json((new UserResource($user))->resolve());
    }
}
