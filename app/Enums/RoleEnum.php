<?php

namespace App\Enums;

use App\Models\Role;

enum RoleEnum: string
{
    case Admin = 'admin';
    case Manager = 'manager';
    case Client = 'client';
    case SuperAdmin = 'super_admin';

    public static function find(string $role): ?Role
    {
        return Role::where('name', $role)->first();
    }

    public static function all(): array
    {
        return [
            self::Admin->value,
            self::Manager->value,
            self::Client->value,
            self::SuperAdmin->value,
        ];
    }
}
