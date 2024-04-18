<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User_profile_public extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'User_profile_public';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'user_id',
        'user_age_public',
        'user_sex_public',
        'created_at',
        'updated_at',
    ];
}
?>