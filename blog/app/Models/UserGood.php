<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserGood extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'great';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'reply_id',
        'clickgood_u',
        'clickgood_e',
        'great_code',
        'many',
        'status',
    ];
}