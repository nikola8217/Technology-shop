<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class HomeAdminController extends Controller
{
    public function index() {
        return view('admin.home');
    }

    public function countUsers() {
        $count = User::count();

        return response()->json([
            'count' => $count
            
        ]);
    }

    public function countCat() {
        $count = Category::count();

        return response()->json([
            'count' => $count
            
        ]);
    }

    public function countProducts() {
        $count = Product::count();

        return response()->json([
            'count' => $count
            
        ]);
    }

    public function lastUser() {
        $last = User::latest()->first();

        return response()->json([
            'last' => $last->email
            
        ]);
    }

    public function lastCat() {
        $last = Category::latest()->first();

        return response()->json([
            'last' => $last->name
            
        ]);
    }

    public function lastProduct() {
        $last = Product::latest()->first();

        return response()->json([
            'last' => $last->name
            
        ]);
    }
}
