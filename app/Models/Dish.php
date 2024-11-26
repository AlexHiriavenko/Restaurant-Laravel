<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'price', 'discount_percent', 'category_id', 'img'];

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

    public function getFinalPriceAttribute()
    {
        return $this->discount_percent
            ? $this->price - ($this->price * $this->discount_percent / 100)
            : $this->price;
    }

    public static function getByCategory($categoryId)
    {
        return self::where('category_id', $categoryId)->with('category')->get();
    }

    public static function getById($dishId)
    {
        return self::with('modifiers', 'category')->findOrFail($dishId);
    }

    public static function getBySlug($slug)
    {
        return self::with('modifiers', 'category')->where('slug', $slug)->firstOrFail();
    }
}
