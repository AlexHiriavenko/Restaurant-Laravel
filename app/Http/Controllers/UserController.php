<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return response()->json($request->user()); // Возвращаем текущего пользователя
    }
}
