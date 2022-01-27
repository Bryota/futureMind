<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use Notifiable;

    public function diagnosis(){
        return $this->hasOne('App\DataProvider\Eloquent\CompanyDiagnosisData','user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard = 'company';
    protected $fillable = [
        'name', 'email', 'password','company_icon','industry','office','employee','homepage','comment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likesStudent(){
        return $this->belongsToMany('App\DataProvider\Eloquent\User','likes','company_id','user_id');
    }
    }

