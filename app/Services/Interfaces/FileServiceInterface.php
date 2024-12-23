<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Http\UploadedFile;

interface FileServiceInterface
{
  public function upload(UploadedFile $file, string $path = ''): string;
  public function delete(string $path): bool;
  public function getUrl(string $path): string;
  public function update(UploadedFile $file, string|null $oldPath, string $path): string;
}
