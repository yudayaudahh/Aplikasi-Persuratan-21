<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [''];
    protected $dates = ['created_at', 'active_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Method action
    public static function storeUser($request)
	{
		$user = self::create($request);
		
		return $user;
	}

    public function updateUser($request){
        return $this->update($request);
    }

    public function deleteUser(){
        return $this->delete();
    }

    public function setPassword($password)
	{
		$this->update([
			'password'	=> Hash::make($password)
		]);
		return $this;
	}

    // Chnage Password
    public function changePassword($request){
        $this->update([
            'password'	=> Hash::make($request)
        ]);
        return $this;
    }
}
