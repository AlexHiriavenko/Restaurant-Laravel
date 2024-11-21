<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'discount_percent', 'category_id', 'img'];

    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Связь с модификаторами
    public function modifiers()
    {
        return $this->belongsToMany(Modifier::class, 'dish_modifiers');
    }
}
