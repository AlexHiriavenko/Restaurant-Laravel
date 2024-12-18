<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class UserService
{
  protected FileService $fileService;

  public function __construct(FileService $fileService)
  {
    $this->fileService = $fileService;
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
}
