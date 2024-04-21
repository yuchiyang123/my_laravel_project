<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class WorkScore extends Model
{
    protected $table = 'work_score';

    protected $guarded = ['id'];

    protected $fillable = [
        'rater_id', 'article_id', 'evaluated_id', 'score', 'tag', 'comments', 'status'
    ];
}