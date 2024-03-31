<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPostMjoin extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'mjoin';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'title',
        'destination',
        'good',
        'time',
        'people',
        'money',
        'description',
        'posted_by',
        'date',
        'status'
    ];
}