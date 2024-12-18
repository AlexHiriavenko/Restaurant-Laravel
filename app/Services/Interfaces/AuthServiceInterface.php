<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface AuthServiceInterface
{
    public function login(array $credentials, bool $rememberMe): array;

    public function logout(User $user): void;

    public function register(array $data): User;
}
