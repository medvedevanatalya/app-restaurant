<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'position_id',
        'full_name',
        'address',
        'phone_number'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //проверка на админа
    public function is_admin()
    {
        $role = $this->role;

        if($role == 'administrator')
        {
            return true;
        }

        return false;
    }

    // возвращает должность
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
