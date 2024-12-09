<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Exceptions\UnauthorizedException;

class AuthService
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
        : Carbon::now()->addSeconds(120)
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
}
