<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Exceptions\UnauthorizedException;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function login(array $credentials, bool $rememberMe): array
    {
        // Проверяем данные с помощью Auth::attempt
        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedException('The provided credentials are incorrect.');
        }

        // Получаем аутентифицированного пользователя
        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->delete();

        // Генерируем и записываем токен
        $token = $user->createToken(
            'API Token',
            ['*'], // Разрешения токена
            $rememberMe
                ? Carbon::now()->addDays(30)
                : Carbon::now()->addHours(2)
        );

        // Возвращаем данные токена
        return [
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }

    public function logout(User $user): void
    {
        /** @var \Laravel\Sanctum\PersonalAccessToken|null $token */
        $token = $user->currentAccessToken();

        if ($token) {
            $token->delete();
        }
    }

    public function register(array $data): User
    {
        $avatarPath = null;

        // Создание пользователя
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $avatarPath,
            'role_id' => 3, // ID роли "client" по умолчанию
        ]);
    }
}
