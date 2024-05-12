<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Notify extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'notify';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'user_id',
        'receiver_id',
        'main',
        'status',
        'come_from',
        'created_at',
        'updated_at',
    ];
}
?>