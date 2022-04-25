<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index() {
        return view('menadzer.blogs');
    }

    public function createBlog(Request $request) {
        $title = $request->title;
        $text = $request->text;
        $img = $request->img;

        if(empty($title) || empty($text) || empty($img)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if(Blog::where('title', '=', $title)->first()) {
            return response()->json(['error'=>'Blog sa ovim naslovom već postoji!']);
        }

        else {
            $blog = Blog::createBlog($title, $text, $img);

            return response()->json([
                'success'=>'Uspešno ste kreirali blog!',
                'blog' => $blog
                
            ]);


        }
    }

    public function getBlogs() {
        $blogs = Blog::getBlogs();

        return response()->json([
            'blogs' => $blogs
            
        ]);
    }

    public function blog($id) {
        
        return view('blog.blog',[
            'id' => $id
        ]); 
    
    }

    public function getBlog($id) {
        
        $blog = Blog::getBlog($id);
        

        return response()->json([
            'blog' => $blog 
            
        ]);
    
    }

    public function editBlog(Request $request) {
        $id = $request->id;
        $title = $request->title;
        $text = $request->text;
        $img = $request->img;

        if(empty($title) || empty($text) || empty($img)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else {
            $blog = Blog::editBlog($id, $title, $text, $img);

            return response()->json([
                'success'=>'Uspešno ste izmenili blog!',
                'blog' => $blog
                
            ]);


        }
    }

    public function deleteBlog($id) {
        
        Blog::where('id', $id)->delete();

    }

    public function blogPage() {
        return view('guest.blogs');
    }

    public function getAllBlogs() {
        $data = Blog::getAllBlogs();
    
        return response()->json($data);
    }

    public function blogView($id) {
        
        return view('blog.blogGuest',[
            'id' => $id
        ]); 
    
    }
}
