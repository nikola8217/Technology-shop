<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeMenController extends Controller
{
    public function index() {
        return view('menadzer.home');
    }
}
