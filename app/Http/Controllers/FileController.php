<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
  protected FileService $fileService;

  public function __construct(FileService $fileService)
  {
    $this->fileService = $fileService;
  }

  /**
   * Загрузка файла.
   */
  public function upload(Request $request)
  {
    $request->validate([
      'file' => 'required|file|max:2048', // Максимум 2MB
    ]);

    $uploadedPath = $this->fileService->upload($request->file('file'), 'imgs');

    return response()->json([
      'message' => 'File uploaded successfully',
      'path' => $uploadedPath,
      'url' => $this->fileService->getUrl($uploadedPath),
    ]);
  }

  /**
   * Удаление файла.
   */
  public function delete(Request $request)
  {
    $request->validate([
      'path' => 'required|string',
    ]);

    if ($this->fileService->delete($request->input('path'))) {
      return response()->json(['message' => 'File deleted successfully']);
    }

    return response()->json(['message' => 'Failed to delete file'], 400);
  }
}
