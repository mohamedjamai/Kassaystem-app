<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use App\Models\sushirolls;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use Illuminate\Database\QueryException;


class DashboardController extends Controller {

    public function vieuw(Request $request)
    {  
        
        $aData = [
            'rootCategories' => Category::where('parent_category_id', null)
        ];
        print_r($aData);
        return view('auth.dashboard');

    }
    public function showDashboard()
    {
        // Haal de kaarten op uit de database
        $sushirolls = DB::table('categories')->where('category_name', 'sushirolls')->get();
    
        // Stuur de kaarten naar de weergave
        return view('dashboard', ['sushirolls' => $sushirolls]);
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
        var_dump($products);
    }
    
}
