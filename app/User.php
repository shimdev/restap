<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = "users";

    protected $fillable = [
        'full_name', 'user_name', 'password', 
        'role', 'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role', 'role');
    }

    public function hasRole($role)
    {
        $check = $this->role()->where('name', $role)->count();

        if ($check == 1) return true;
        else return false;
    }
}