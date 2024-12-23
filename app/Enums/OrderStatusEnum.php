<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
  case IN_PROGRESS = 'in_progress';
  case DONE = 'done';
  case REJECTED = 'rejected';
}
