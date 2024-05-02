<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'receiver_id', 'message', 'is_read'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 如果有需要隱藏的欄位可以在這裡設定
    ];

    /**
     * Get the user that sent the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that received the message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
