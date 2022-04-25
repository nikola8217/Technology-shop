<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_user',
        'body',
        'user_id',
        'product_id',
        
    ];

    public static function createComment($product_id, $body){
        return Comment::create([
            'name_user' => auth()->user()->name . ' ' . auth()->user()->lastname,
            'body' => $body,
            'user_id' => auth()->user()->id,
            'product_id' => $product_id
        
        ]);
    }

    public static function getComments($product_id) {
        return Comment::where('product_id', '=', $product_id)->orderBy('created_at', 'desc')->paginate(5);
    }
}
