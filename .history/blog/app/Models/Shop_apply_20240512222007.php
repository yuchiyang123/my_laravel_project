<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Shop_apply extends Model
{
    protected $table = 'company_apply'; // Define the table name

    protected $primaryKey = 'id'; // Define the primary key column

    public $timestamps = false; // Assuming there are no created_at and updated_at columns

    protected $fillable = [
        'user_id',
        'company_name',
        'phone_number',
        'uniform_numbers',
        'company_location',
        'county',
        'applicant',
        'image_data',
        'image_type',
        'image_data1',
        'image_type1',
        'date',
        'status',
        'created_at',
        'updated_at',
        'msg'
    ];

    // Define relationships if any
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
