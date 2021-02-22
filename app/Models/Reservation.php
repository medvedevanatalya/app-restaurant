<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date_time_order',
        'date_time_which_order_placed'
    ];

    // возвращает клиента
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // возвращает столик
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
