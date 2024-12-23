<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModifier extends Model
{
  use HasFactory;

  protected $fillable = ['order_item_id', 'modifier_id', 'name', 'price'];
}
