<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    // возвращает все ингредиенты
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredients_dishes', 'dish_id', 'ingredient_id');
    }

    // возвращает все заказы
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_dishes', 'dish_id', 'order_id');
    }
}
