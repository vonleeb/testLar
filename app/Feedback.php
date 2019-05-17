<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    const ALLOWED_SORT = ['Name' => 'user_name',
                          'Email' => 'email',
                          'Date' => 'created_at',
        ];
    const DEFAULT_SORT = 'created_at';

    protected $table = 'feedbacks';
    protected $fillable = [
        'user_name', 'email', 'message', 'photo_name',
    ];
}
