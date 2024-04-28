<?php

namespace App\Http\Controllers\Auth;
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

class DashboardController extends Controller {

    public function vieuw(Request $request)
    {  
        
        $aData = [
            'rootCategories' => Category::where('parent_category_id', null)
        ];
        print_r($aData);
        return view('auth.dashboard');

    }
}