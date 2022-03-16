<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageInfo extends Model
{
    use HasFactory;

    protected $table = 'message_info';

    protected $fillable = [
        'room_id', 'user_id', 'company_id', 'message_num', 'checked_status'
    ];
}
