<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = [
        'user_id', 'company_id'
    ];
}
