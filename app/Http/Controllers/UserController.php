<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateAvatarRequest;
use App\Services\RoleService;

class UserController extends Controller

{
    protected UserService $userService;
    protected RoleService $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
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

    /**
     * Показать страницу управления ролями пользователей.
     */
    public function showUpdateRolePage(Request $request)
    {
        $searchText = $request->input('searchText', null); // Получаем email или null
        $users = $this->userService->getByInputs($searchText);
        $roles = $this->roleService->getAllRoles();

        return view('users.update-role', [
            'users' => $users,
            'roles' => $roles,
            'searchText' => $searchText,
        ]);
    }

    /**
     * Обновить роль пользователя.
     */
    public function updateRole(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        // проверка есть ли права на изенение роли
        $this->authorize('updateAny', User::class);

        $this->userService->updateRole($request->input('user_id'), $request->input('role_id'));

        return redirect()->route('users.update-role')->with('success', 'Role updated successfully!');
    }
}
