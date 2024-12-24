<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\MailService;

class SendEmailSalesAnalytics implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $email;
  protected $subject;
  protected $template;
  protected $data;
  protected $attachments;

  /**
   * Создаем Job с данными для отправки письма.
   */
  public function __construct(string $email, string $subject, string $template, array $data, array $attachments)
  {
    $this->email = $email;
    $this->subject = $subject;
    $this->template = $template;
    $this->data = $data;
    $this->attachments = $attachments;
  }

  /**
   * Обработка задания.
   */
  public function handle(MailService $mailService)
  {
    $mailService->sendHtmlEmail(
      $this->email,
      $this->subject,
      $this->template,
      $this->data,
      $this->attachments // Массив путей к файлам
    );
  }
}
