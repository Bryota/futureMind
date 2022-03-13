<?php

namespace App\DataProvider\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * guard
     * @var string
     */
    protected $guard = 'user';

    protected $fillable = [
        'name', 'email', 'password', 'year', 'university', 'industry', 'hobby', 'club', 'hometown'
    ];

    /**
     * @return BelongsToMany
     */
    public function likesCompany(): BelongsToMany
    {
        return $this->belongsToMany('App\DataProvider\Eloquent\Company', 'likes', 'user_id', 'company_id');
    }
}
