<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role(){

        return $this->hasMany('App\Models\user_permissions','email','email');
      }
  
      public function hasAnyRole($roles)
     {
         if (is_array($roles)) {
             foreach ($roles as $role) {
                 if ($this->hasRole($role)) {
                     return true;
                 }
             }
         } else {
             if ($this->hasRole($roles)) {
                 return true;
             }
         }
         return false;
     }
  
     public function hasRole($role)
     {
         if ($this->role()->where('permission_level',$role)->first()) {
             return $role;
         }
         return false;
     }
     public function hasAnyLocation($locs)
    {
        if (is_array($locs)) {
            foreach ($locs as $loc) {
                if ($this->hasLocation($loc)) {
                    return true;
                }
            }
        } else {
            if ($this->hasLocation($loc)) {
                return true;
            }
        }
        return false;
    }
    public function hasLocation($loc)
    {
        if ($this->role()->where('location_id',$loc)->first()) {
            return $loc;
        }
        return false;
    }
}
