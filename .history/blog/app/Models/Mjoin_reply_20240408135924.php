<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mjoin_reply extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'reply';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'reply_id',
        'name_e',
        'name_u',
        'main',
        'good',
        'status',
        'created_at',
        'updated_at'
    ];
}