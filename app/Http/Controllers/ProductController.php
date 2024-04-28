<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Methode om producten op te halen op basis van de categorie
    public function getProductsByCategory(Request $request) {

        $category = $request->input('category');
        var_dump($category);
        $products = Product::where('category_id', $category)->get();
        return response()->json($products);
    }

}


