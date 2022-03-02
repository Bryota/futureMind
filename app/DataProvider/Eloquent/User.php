<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'user';

    protected $fillable = [
        'name', 'email', 'password','year','university','industry','hobby','club','hometown'
    ];

    public function likesCompany()
    {
        return $this->belongsToMany('App\DataProvider\Eloquent\Company','likes','user_id','company_id');
    }
}
