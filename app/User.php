<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password', 'role_id', 'department_id', 'store_id', 'token'
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

    public function role(){
        return $this -> belongsTo(Role::class);
    }

    public function department(){
        return $this -> belongsTo(Department::class);
    }

    public function store(){
        return $this -> belongsTo(Store::class);
    }

    public static function createUser($request, $role_id = 1, $store_id = null, $department_id = null){
        $create_user = new User();
        $create_user->email = $request->email;
        $create_user->password = bcrypt($request->password);
        $create_user->role_id = $role_id;
        $create_user->store_id = $store_id;
        $create_user->department_id = $department_id;
        $create_user->token = Str::random(15);
        $create_user->save();
        return $create_user;
    }

}
