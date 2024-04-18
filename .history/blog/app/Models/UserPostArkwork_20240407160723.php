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
    protected $table = 'mjoin';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'image_data',
        'image_type',
        'title',
        'class',
        'main',
        'posted_by_u',
        'posted_by_e',
        'money',
        'sex',
        'skill',
        'age',
        'description',
        'posted_by',
        'date',
        'status'
    ];
}