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
        'username','last_name', 'name', 'email', 'password', 'profile'
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
     * get the Spanish string of the profile
     * 
     * @return string $string
     */
    public function getProfile(){
        switch($this->profile){
            case 'administrator':
                return 'Administrador';
                break;
            case 'editor':
                return 'Editor';
                break;
            default:
                return 'No disponible';
        }
    }
}
