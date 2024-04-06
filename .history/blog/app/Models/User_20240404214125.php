<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //模型資料表->user
    protected $table = 'user';

    protected $guarded = ['id'];

    //欄位
    protected $fillable = [
        'username',
        'email',
        'password',
        'permissions',
        'age',
        'state',
        'verify',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    
}
