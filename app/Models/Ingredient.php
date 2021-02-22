<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'price',
        'available_quantity'
    ];

    // возвращает все блюда
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'ingredients_dishes', 'ingredient_id', 'dish_id');
    }
}
