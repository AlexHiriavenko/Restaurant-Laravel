<?php

namespace App\Services;

use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService implements FileServiceInterface
{
  protected string $disk;

  public function __construct(string $disk = 'public')
  {
    $this->disk = $disk;
  }

  /**
   * Загрузка файла в хранилище.
   */
  public function upload(UploadedFile $file, string $path = ''): string
  {
    return Storage::disk($this->disk)->put($path, $file);
  }

  /**
   * Удаление файла из хранилища.
   */
  public function delete(string $path): bool
  {
    return Storage::disk($this->disk)->delete($path);
  }

  /**
   * Получение ссылки на файл.
   */
  public function getUrl(string $path): string
  {
    /** @var FilesystemAdapter $disk */
    $disk = Storage::disk($this->disk);

    return $disk->url($path);
  }

  /**
   * Обновление файла: удаляет старый и загружает новый.
   */
  public function update(UploadedFile $file, string|null $oldPath, string $path): string
  {
    // Удаляем старый файл, если он существует
    if ($oldPath) {
      $this->delete($oldPath);
    }

    // Загружаем новый файл
    return $this->upload($file, $path);
  }
}
