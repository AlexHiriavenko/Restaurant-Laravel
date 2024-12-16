<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return response()->json($users);
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        return response()->json((new UserResource($user))->resolve());
    }
}
