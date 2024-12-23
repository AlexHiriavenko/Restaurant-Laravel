<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailService
{
  /**
   * Отправка простого текста
   */
  public function sendTextEmail(string $to, string $subject, string $message): bool
  {
    try {
      Mail::raw($message, function ($mail) use ($to, $subject) {
        $mail->to($to)
          ->subject($subject);
      });
      return true;
    } catch (\Exception $e) {
      Log::error('Ошибка отправки письма: ' . $e->getMessage());
      return false;
    }
  }

  /**
   * Отправка письма с HTML-шаблоном
   */
  public function sendHtmlEmail(string $to, string $subject, string $view, array $data = []): bool
  {
    try {
      Mail::send($view, $data, function ($mail) use ($to, $subject) {
        $mail->to($to)
          ->subject($subject);
      });
      return true;
    } catch (\Exception $e) {
      Log::error('Ошибка отправки HTML письма: ' . $e->getMessage());
      return false;
    }
  }
}
