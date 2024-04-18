<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPostArkwork extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'artwork';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'image_data',
        'image_type',
        'title',
        'class',
        'main',
        'user_id',
        'status'
    ];
}