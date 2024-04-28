<?php


namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use Illuminate\Database\QueryException;


class YController extends Controller
{

    public function vieuw(Request $request)
    {
        $iCategoryId = $request->get('category_id');
        if(empty($iCategoryId))
        {
            $iCategoryId = '0';
        }


       $products = Product::where('category_id', $iCategoryId)->get();
/*
       foreach($products as $product)
       {
        echo  $product->product_name . " <br>";
       }

       var_dump($products);
      exit();
      */
        $aData = [
            'rootCategories' => Category::where('parent_category_id', null)->get(),
            'products' => $products
        ];

       // print_r($aData);
        return view('dashboard', $aData);

    }

    public function viewProducts(Request $request)
    {
        try {
            $products = Products::all();
            dd($products);
        } catch (QueryException $e) {
            // Vang eventuele fouten op en toon een foutmelding
            dd($e->getMessage());
        }

        // Stuur de productgegevens naar de weergave
        return view('dashboard', ['products' => $products]);
    }
    public function showDashboard()
    {
        // Haal de kaarten op uit de database
        $sushirolls = DB::table('categories')->where('category_name', 'sushirolls')->get();

        // Stuur de kaarten naar de weergave
        return view('dashboard', ['sushirolls' => $sushirolls]);
    }
}
