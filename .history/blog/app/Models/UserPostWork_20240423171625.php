<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPostWork extends Authenticatable
{
    use HasFactory, Notifiable;
    //資料表
    protected $table = 'shop';
    //禁止串改
    protected $guarded = ['id'];
    //欄位
    protected $fillable = [
        'shop_name',
        'selectwhere',
        'business_registration_number',
        'location',
        'driver_license_requirements',
        'recruitment_period',
        'sex',
        'language',
        'conditions_exp',
        'work_hours',
        'job_description',
        'benefits',
        'shop_information',
        'posted_by_u',
        'posted_by_e',
        'status',
    ];
}