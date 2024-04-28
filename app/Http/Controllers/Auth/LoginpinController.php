<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class LoginpinController extends BaseController
{
    public function vieuw(Request $request) 
    {
        $nummers = range(0,9);
        $templatevars = [
            'nummers' => $nummers
        ];

       // var_dump($templatevars);
        // exit();
        // https://php.net/<functienaa>
        // https://php.net/range
        // https://laravel.com/docs/10.x/blade

        return view('auth.loginpin', $templatevars);
    }

// Aangepaste controllerlogica (AuthController.php) voor pincode-authenticatie en doorverwijzing
public function loginWithPincode(Request $request)
{
    // Voer de pincode-authenticatie uit en controleer of deze correct is
    if ($this->validatePincode($request->pincode)) {
        // Voer de standaard login-authenticatie uit (bijvoorbeeld met e-mail/wachtwoord)
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Als de standaard login-authenticatie slaagt, doorverwijzen naar het dashboard
            return redirect('/dashboard');
        }
    }

    // Als de pincode-authenticatie of de standaard login-authenticatie mislukt, doorverwijzen naar de loginpagina met een foutmelding
    return redirect('/login')->with('error', 'Onjuiste pincode of inloggegevens.');
}



    public function loginWithPin(Request $request)
    {
       
        //var_dump($_POST);

        //var_dump($request);        // Valideer de pincode
        /*
        $request->validate([
            'pin_code' => ['required', 'digits:5'],
        ]);
*/
    
        // Zoek de gebruiker met de opgegeven pincode
        $user = User::where('pin_code', $request->pin_code)->first();
  //  var_dump($user->name);
    
        

        // Controleer of de gebruiker bestaat en log de gebruiker in als de pincode correct is
        if ($user) {
            Auth::login($user);
            
            return redirect('/dashboard');
        }
    
        // Als de pincode onjuist is, stuur een foutmelding
        exit('Gebruiker is niet gevonden met de aangegeven pincode, probeer in te loggen door middel van je email en wachtwoord. ');
        return response()->redirectTo(['/login' , ['fail'=> 1]]);
    }
}    