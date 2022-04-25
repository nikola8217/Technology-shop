<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'img',
        'created_by'
    ];

    public static function createBlog($title, $text, $img){
        return Blog::create([
            'title' => $title,
            'body' => $text,
            'img' => $img,
            'created_by' => auth()->user()->name . ' ' . auth()->user()->lastname
        
        ]);
    }

    public static function getBlogs() {
        return Blog::all();
    }

    public static function getBlog($id) {
        return Blog::where('id', '=', $id)->get();
    }

    public static function editBlog($id, $title, $text, $img) {
        return Blog::where('id', $id)->update([
            'title' => $title,
            'body' => $text,
            'img' => $img  
        ]);
    }

    public static function getAllBlogs() {
        // $blogs = new Blog();

        return Blog::orderBy('created_at', 'desc')->paginate(3);
    }
}
