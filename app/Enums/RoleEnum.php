<?php

namespace App\Enums;

enum RoleEnum: string
{
    case Admin = 'admin';
    case Manager = 'manager';
    case Client = 'client';
    case SuperAdmin = 'super_admin'; // Добавили новую роль

    public static function all(): array
    {
        return [
            self::Admin->value,
            self::Manager->value,
            self::Client->value,
        ];
    }
}
