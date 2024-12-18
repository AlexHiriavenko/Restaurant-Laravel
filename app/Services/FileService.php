<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
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
}
