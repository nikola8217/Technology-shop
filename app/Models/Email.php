<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'subject',
        'body'
    ];

    public static function sendMessage($email, $subject, $text){
        return Email::create([
            'email' => $email,
            'subject' => $subject,
            'body' => $text
        
        ]);
    }

    public static function getMessages() {
        return Email::orderBy('created_at', 'desc')->get();
    }

    public static function getMsg($id) {
        return Email::where('id', '=', $id)->get();
    }
}
