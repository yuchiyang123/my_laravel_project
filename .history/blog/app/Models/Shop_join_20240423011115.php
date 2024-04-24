<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Shop_Join extends Model
{
    // 定義表格名稱
    protected $table = 'shop_join';

    // 定義主鍵列名稱
    protected $primaryKey = 'id';

    // 如果你的表格中有自動增長的主鍵，你可以將它設置為 false
    public $incrementing = true;

    // 如果你的主鍵列不是 int 類型，你可以將它設置為 false
    protected $keyType = 'int';

    // 如果你的表格中沒有 created_at 和 updated_at 列，你可以將它們設置為 false
    public $timestamps = true;

    // 定義可以批量賦值的欄位
    protected $fillable = ['name', 'user_id', 'email', 'contact_number', 'job_type', 'expected_salary', 'work_experience', 'personality', 'educational_background', 'availability', 'driving_license', 'motivation','status', 'level'];

    // 定義與 User 模型的關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
