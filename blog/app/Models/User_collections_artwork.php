<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User_collections_artwork extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'user_collections_artwork';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'user_id',
        'article_id',
        'created_at',
        'updated_at',
        'status',
    ];
}
?>