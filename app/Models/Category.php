<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image'];

    // Связь с блюдами
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // Метод для получения всех категорий
    public static function getAllCategories()
    {
        return self::all();
    }
}
