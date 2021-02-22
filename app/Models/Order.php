<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 *
 * @property boolean $status
 */

class Order extends Model
{
    protected $fillable = [
        'id', 'status', 'date', 'client_id', 'user_id'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    //выполнен ли заказ
    function isCompleted()
    {
        return $this->status;
    }

    // возвращает клиента
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // возвращает персонал
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //возвращает блюда заказа
    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'orders_dishes', 'order_id', 'dish_id');
    }
}
