<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'phone', 'address', 'type', 'status', 'total_price'];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}