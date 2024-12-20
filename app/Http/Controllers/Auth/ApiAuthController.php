<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiLoginRequest;
use App\Http\Requests\Auth\ApiRegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(ApiLoginRequest $request): JsonResponse
    {
        // Получаем валидированные данные
        $validated = $request->validated();

        // Извлекаем только необходимые поля для авторизации
        $credentials = collect($validated)->only(['email', 'password'])->toArray();

        // Вызываем сервис для авторизации и получения токена
        $tokenData = $this->authService->login(
            $credentials, // тут передаем только email и password
            $request->boolean('rememberMe', false) // rememberMe (по умолчанию false)
        );

        // Возвращаем ответ с токеном
        return response()->json($tokenData);
    }

    public function logout(Request $request): JsonResponse
    {
        // Передаем текущего пользователя в сервис
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function register(ApiRegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $credentials = collect($validated)
            ->only(['name', 'email', 'password'])->toArray();

        $user = $this->authService->register($credentials);

        return response()->json([
            'message' => 'Пользователь успешно зарегистрирован.',
            'user' => $user,
        ], 201);
    }
}
