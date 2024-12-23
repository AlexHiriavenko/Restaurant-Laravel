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
   * $mailService->sendHtmlEmail(
   * 'получатель@example.com',
   * 'Заголовок Письма',
   * 'emails.template', 
   * ['key' => 'value'],
   * [storage_path('app/public/imgs/categories/drinks/coffee.jpg')] 
   * )
   */
  public function sendHtmlEmail(string $to, string $subject, string $view, array $data = [], array $attachments = []): bool
  {
    try {
      Mail::send($view, $data, function ($mail) use ($to, $subject, $attachments) {
        $mail->to($to)->subject($subject);

        // Если вложения есть, добавляем их
        if (!empty($attachments)) {
          foreach ($attachments as $attachment) {
            $mail->attach($attachment);
          }
        }
      });
      return true;
    } catch (\Exception $e) {
      Log::error('Ошибка отправки HTML письма: ' . $e->getMessage());
      return false;
    }
  }
}
