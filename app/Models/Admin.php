<?php

namespace App\Models;

use App\Traits\UtilTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    //
    use UtilTrait;
    protected $guard = 'admin';
    public $incrementing = false;
    public $timestamps = FALSE;
    protected $table = 'admins';
    protected $fillable = [
        'login_id',
        'login_pw'
    ];

    public function getAuthPassword()
    {
        return $this->attributes['login_pw'];
    }

    public function setLoginPwAttribute($password)
    {
        $this->attributes['login_pw'] = Hash::make($password);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
