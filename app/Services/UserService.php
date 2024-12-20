<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\UploadedFile;

class UserService
{
    protected FileService $fileService;
    protected UserRepository $userRepository;

    public function __construct(FileService $fileService, UserRepository $userRepository)
    {
        $this->fileService = $fileService;
        $this->userRepository = $userRepository;
    }

    /**
     * Обновление аватара пользователя.
     */
    public function updateAvatar(User $user, UploadedFile $file): string
    {
        // Путь для сохранения файлов аватаров
        $uploadPath = 'imgs/avatars';

        // Обновляем файл и получаем новый путь
        $uploadedPath = $this->fileService->update($file, $user->avatar, $uploadPath);

        // Обновляем путь в базе данных
        $user->avatar = $uploadedPath;
        $user->save();

        return $uploadedPath;
    }

    /**
     * Обновление роли пользователя.
     */
    public function updateRole(int $userId, int $roleId): void
    {
        $this->userRepository->update($userId, ['role_id' => $roleId]);
    }

    /**
     * Получение пользователей по email.
     */
    /**
     * Получить пользователей по email.
     *
     * @param string|null $email Часть email для поиска
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByInputs(string|null $inputValue)
    {
        $inputValue = $inputValue ?? '';
        return $this->userRepository->getByLike(['email' => $inputValue, 'name' => $inputValue]);
    }
}
