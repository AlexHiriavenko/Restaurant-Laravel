<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    // Связь с блюдами
    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class, 'dish_modifiers');
    }
}
