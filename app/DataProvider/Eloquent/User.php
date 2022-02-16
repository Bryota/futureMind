<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password','year','university','industry','hobby','club','hometown'
    ];

    public function likesCompany()
    {
        return $this->belongsToMany('App\DataProvider\Eloquent\Company','likes','user_id','company_id');
    }
}
