<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'dokumen_pendukung', 'bentuk_badan_usaha', 'nama_badan_usaha',
        'npwp_badan_usaha', 'scan_npwp', 'is_registration_confirmed', 'is_default_password_has_changed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){

        return $this->belongsToMany('App\Role');
    }

    //----Authorization blocks--
    public function hasRole($role)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        if (is_string($role)) {
            return $this->role->contains('name', $role);
        }
        return !! $this->roles->intersect($role)->count();
    }

    public function isSuperAdmin()
    {
       if ($this->roles->contains('name', 'Super Admin')) {
            return true;
        }
        return false;
    }
    //----ENDAuthorization blocks---
}
