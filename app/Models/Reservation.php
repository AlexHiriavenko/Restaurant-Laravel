<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  use HasFactory;

  protected $table = 'reservations';

  protected $fillable = [
    'user_id',
    'table_id',
    'reservation_date',
    'start_time',
    'end_time',
    'phone_number',
    'name',
  ];

  // Отношение к пользователю
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Отношение к столу
  public function table()
  {
    return $this->belongsTo(Table::class);
  }
}
