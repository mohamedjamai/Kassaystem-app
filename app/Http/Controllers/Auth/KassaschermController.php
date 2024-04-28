<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class KassaschermController extends BaseController
{
    public function vieuw()

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

        return view('auth.kassascherm', $templatevars);
    }
}
