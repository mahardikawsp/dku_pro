<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','no_hp','id_location','id_leader','id_position','tipe','photo','imei','id_jamker'
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
    
    public static function allJoin(){
        return $user = DB::table('users')
            ->leftJoin('positions', 'users.id_position', '=', 'positions.id_position')
            ->leftJoin('locations','users.id_location', '=', 'locations.id_location')
            ->leftJoin('jamkers','users.id_jamker','=','jamkers.id_jamker')
            ->paginate(10);
    }
}
