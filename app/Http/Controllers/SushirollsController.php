<?php

namespace App\Http\Controllers;
use App\Models\sushirolls;
use Illuminate\Http\Request;

class SushirollsController extends Controller
{
    public function view()
    {
        $sushirolls = Sushirolls::all();
        return view('dashboard', compact('sushirolls'));
    }
}
