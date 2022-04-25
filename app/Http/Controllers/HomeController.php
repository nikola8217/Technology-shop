<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('guest.home');
    }

    public function about(){
        return view('guest.about');
    }

    public function contact() {
        return view('guest.contact');
    }

    public function products() {
        return view('guest.products');
    }

    public function productsByCat($id) {

        return view('guest.productsByCat',[
            'id' => $id
        ]); 
    }

    public function product($id) {

        return view('guest.product',[
            'id' => $id
        ]); 
    }
}
