<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function products($id) {

        return view('admin.product',[
            'id' => $id
        ]); 
    }

    public function getProducts($id) {
        
        $data = Product::getProductsByCat($id);

        // dd($data);
    
        return response()->json($data);
        
    }

    public function getProducts1($id) {
        
        $products = Product::getProductsByCat1($id);

        // dd($data);
    
        return response()->json([
            'products' => $products
            
        ]);
        
    }

    public function getProduct($id) {
        
        $product = Product::getProduct($id);
        

        return response()->json([
            'product' => $product
            
        ]);
    
}

    public function createProduct(Request $request) {
        $name = $request->name;
        $desc = $request->desc;
        $price = $request->price;
        $img = $request->img;
        $id = $request->cat_id;

        if(empty($name) || empty($desc) || empty($price) || empty($img)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if(Product::where('name', '=', $name)->first()) {
            return response()->json(['error'=>'Proizvod već postoji!']);
        }

        else {
            $product = Product::createPro($name, $desc, $price, $img, $id);

            return response()->json([
                'success'=>'Uspešno ste kreirali proizvod!',
                'proizvod' => $product
                
            ]);


        }
    }

    public function editproduct(Request $request) {
        $id = $request->id;
        $name = $request->name;
        $desc = $request->desc;
        $price = $request->price;
        $img = $request->img;

        if(empty($name) || empty($desc) || empty($price) || empty($img)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if(Product::where('name', '=', $name)->first()) {
            return response()->json(['error'=>'Proizvod već postoji!']);
        }

        else {
            $product = Product::editPro($id, $name, $desc, $price, $img);

            return response()->json([
                'success'=>'Uspešno ste izmenili proizvod!',
                'proizvod' => $product
                
            ]);


        }
    }

    public function deleteProduct($id) {
        
        Product::where('id', $id)->delete();

    }

    

}
