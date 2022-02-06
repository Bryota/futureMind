<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageInfo extends Model
{
    use HasFactory;

    protected $table = 'message_info';

    protected $fillable = [
        'room_id', 'student_user', 'company_user', 'message_num', 'checked_status'
    ];
}
