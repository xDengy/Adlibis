<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    protected $fillable = [
        'text',
        'news_id'
    ];
}
