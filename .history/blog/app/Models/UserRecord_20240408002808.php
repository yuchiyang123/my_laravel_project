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
    protected $table = 'record';

    protected $guarded = ['id'];

    //欄位
    protected $fillable = [
        'userid',
        'username',
        'ip',
        'logintime',
        'loginmany',
        'userstatus',
        'created_at',
        'update_at',
    ];

    
}
