<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class ShopReply extends Model
{
    // 定義表格名稱
    protected $table = 'shop_reply';

    // 定義主鍵列名稱
    protected $primaryKey = 'id';

    // 如果你的表格中有自動增長的主鍵，你可以將它設置為 false
    public $incrementing = true;

    // 如果你的主鍵列不是 int 類型，你可以將它設置為 false
    protected $keyType = 'int';

    // 如果你的表格中沒有 created_at 和 updated_at 列，你可以將它們設置為 false
    public $timestamps = true;

    // 定義可以批量賦值的欄位
    protected $fillable = ['reply_id', 'name_e', 'name_u', 'main', 'good', 'status', 'level'];
}