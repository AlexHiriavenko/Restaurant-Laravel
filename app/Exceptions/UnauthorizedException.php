<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
  public function render($request)
  {
    return response()->json([
      'message' => $this->getMessage() ?: 'Unauthorized'
    ], 401);
  }
}
