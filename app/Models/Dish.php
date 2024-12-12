<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'price', 'discount_percent', 'category_id', 'img'];

    // Связь с категорией
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Связь с модификаторами
    public function modifiers(): BelongsToMany
    {
        return $this->belongsToMany(Modifier::class, 'dish_modifiers');
    }

    // аксессор метод - цена с учетом скидки
    public function getFinalPriceAttribute(): float
    {
        return $this->discount_percent
            ? $this->price - ($this->price * $this->discount_percent / 100)
            : $this->price;
    }
}
