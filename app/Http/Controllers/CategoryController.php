<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories() {
        return view('admin.category');
    }

    public function getCategories() {
        $category = Category::getCategories();

        return response()->json([
            'categories' => $category
            
        ]);
    }

    public function createCat(Request $request) {
        $name = $request->name;

        if(empty($name)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if(Category::where('name', '=', $name)->first()) {
            return response()->json(['error'=>'Kategorija već postoji!']);
        }

        else {
            $kategorija = Category::createCat($name);

            return response()->json([
                'success'=>'Uspešno ste kreirali kategoriju!',
                'kategorija' => $kategorija
                
            ]);


        }
    }

    public function editCat(Request $request) {
        $id = $request->id;
        $name = $request->name;

        if(empty($name)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if(Category::where('name', '=', $name)->first()) {
            return response()->json(['error'=>'Kategorija već postoji!']);
        }

        else {
            $kategorija = Category::editCat($id, $name);

            return response()->json([
                'success'=>'Uspešno ste izmenili kategoriju!',
                'kategorija' => $kategorija
                
            ]);


        }
    }

    public function deleteCat($id) {
        
        Category::where('id', $id)->delete();

    }
}
