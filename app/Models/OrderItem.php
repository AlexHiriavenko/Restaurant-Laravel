<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'dish_id', 'quantity', 'price', 'total_price'];

    public function modifiers(): HasMany
    {
        return $this->hasMany(OrderItemModifier::class);
    }
}
