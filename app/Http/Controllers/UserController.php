<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateAvatarRequest;

class UserController extends Controller

{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

    public function updateAvatar(UpdateAvatarRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        // Обновляем аватар
        $uploadedPath = $this->userService->updateAvatar($user, $request->file('avatar'));

        return response()->json([
            'message' => 'Avatar updated successfully',
            'avatar_url' => asset('storage/' . $uploadedPath),
        ]);
    }
}
