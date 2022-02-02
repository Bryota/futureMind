<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageNum extends Model
{
    use HasFactory;

    protected $table = 'message_num';

    protected $fillable = [
        'room_id', 'student_user', 'company_user', 'message_num'
    ];
}
