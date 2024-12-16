<?php

namespace App\Http\Requests\Traits;

use Illuminate\Support\Facades\Auth;

trait AccessAllData
{
    /**
     * Определяет user_id из маршрута или использует ID авторизованного пользователя.
     */
    public function defineUserId(): int
    {
        return $this->route('id') ?? Auth::id();
    }

    /**
     * Проверяет, есть ли у пользователя доступ на основе разрешения.
     */
    public function can(): bool
    {
        $userId = $this->defineUserId();

        // Проверяем, есть ли у пользователя необходимое разрешение
        /** @var User $user */
        $user = Auth::user();
        return $user && $user->can($this->getPermission());
    }

    /**
     * Метод для определения разрешения.
     * Этот метод должен быть реализован в классе, использующем трейт.
     */
    abstract protected function getPermission(): string;
}
