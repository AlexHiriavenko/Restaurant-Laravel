<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
  protected $allowedRoles = ['admin', 'manager', 'super_admin'];

  public function handle(Request $request, Closure $next)
  {
    // Проверяем роль пользователя
    if (!in_array(Auth::user()->role->name, $this->allowedRoles)) {
      // Выполняем логаут
      $email = Auth::user()->email;
      Auth::logout();
      // Перенаправляем на страницу логина с ошибкой
      return redirect()
        ->route('login')
        ->withErrors(['message' => 'Доступ запрещен: недостаточно прав.'])
        ->withInput(['email' => $email]);
    }

    // Если все проверки пройдены, продолжаем выполнение запроса
    return $next($request);
  }
}
