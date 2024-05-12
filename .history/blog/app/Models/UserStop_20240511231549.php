<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStop extends Model
{
    use HasFactory;

    protected $table = 'user_stop'; // 指定資料表名稱

    protected $fillable = [ // 可批量賦值的屬性
        'user_id',
        'message',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
