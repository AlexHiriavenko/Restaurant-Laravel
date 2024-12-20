<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class UserRepository
{
    /**
     * Получить пользователей по точным совпадениям.
     *
     * @param array $conditions Условия для точного поиска (колонка => значение)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByExactMatch(array $conditions): Collection
    {
        return User::where($conditions)->get();
    }

    /**
     * Получить пользователей по условиям с использованием LIKE.
     *
     * @param array $conditions Условия для поиска с LIKE (колонка => значение)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByLike(array $conditions): Collection
    {
        $query = User::query();

        foreach ($conditions as $column => $value) {
            if (!empty($value)) {
                $query->orWhere($column, 'like', "%$value%");
            }
        }

        return $query->get();
    }

    /**
     * Обновить данные пользователя.
     *
     * @param int $id ID пользователя
     * @param array $attributes Данные для обновления
     * @return void
     */
    public function update(int $id, array $attributes): void
    {
        $user = User::findOrFail($id);
        $user->update($attributes);
    }
}
