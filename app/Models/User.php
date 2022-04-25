<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'brBodova',
    ];

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

    public static function register($name, $lastname, $email, $password){
        return User::create([
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => Hash::make($password),
            'brBodova' => 0
        
        ]);
    }

    public static function getUsers() {
        return User::all();
    }

    public static function editUser($user_id, $name, $lastname) {
        return User::where('id', $user_id)->update([
            'name' => $name, 
            'lastname' => $lastname, 
        ]);
    }

    public static function getUser() {
        return User::where('id', auth()->user()->id)->first();
    }

    public static function updatePoints($points) {
        return User::where('id', auth()->user()->id)->update([
            'brBodova' => $points
        ]);
    }

    public static function changePass($id, $pass) {
        return User::where('id', $id)->update([
            'password' => Hash::make($pass), 
             
        ]);
    }
}
