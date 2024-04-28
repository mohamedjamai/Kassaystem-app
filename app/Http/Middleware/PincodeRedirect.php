<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PincodeRedirect
{
    public function handle($request, Closure $next)
    {

        if(isset($request->pin_code))
        {
             // Zoek de gebruiker met de opgegeven pincode
         $user = User::where('pin_code', $request->pin_code)->first();
         //  var_dump($user->name);
           
               

        // Controleer of de gebruiker bestaat en log de gebruiker in als de pincode correct is
        if ($user) {
            Auth::login($user);
            
            return redirect('/dashboard');
        }
    }
        return $next($request);
    }
}
