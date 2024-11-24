<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Загружаем пользователей с их ролями
        $users = User::with('role')->get();

        dd($users);
    }
}
