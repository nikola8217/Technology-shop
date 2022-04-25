<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public static function createUserRole($user_id, $role_id){
        return UserRole::create([
            "user_id" => $user_id,
            "role_id" => $role_id 
        ]);
    }

    public static function getRoleForUser($user_id){
        return UserRole::where('user_id', $user_id)->get();
    }

    public static function getRoles($user_id) {
        return UserRole::where('user_id', '=', $user_id)
        ->leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')->pluck('roles.name')->toArray();
    }

    public static function getRolesForUser($user_id){
        return UserRole::where('user_id', '=', $user_id)
        ->leftJoin('roles', 'user_roles.role_id', '=', 'roles.id')->get();
    }
}
