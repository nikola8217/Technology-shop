<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'img',
        'category_id'
    ];

    public static function getProductsByCat($category_id) {
        return Product::where('category_id', '=', $category_id)->paginate(9);
    }

    public static function getProductsByCat1($category_id) {
        return Product::where('category_id', '=', $category_id)->get();
    }

    public static function createPro($name, $desc, $price, $img, $cat_id){
        return Product::create([
            'name' => $name,
            'description' => $desc,
            'price' => $price,
            'img' => $img,
            'category_id' => $cat_id
        
        ]);
    }

    public static function editPro($id, $name, $desc, $price, $img) {
        return Product::where('id', $id)->update([
            'name' => $name,
            'description' => $desc,
            'price' => $price,
            'img' => $img  
        ]);
    }

    public static function getProduct($id) {
        return Product::where('id', '=', $id)->get();
    }
}
