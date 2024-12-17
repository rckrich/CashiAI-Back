<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(Auth::check()){
            return redirect('/interactions');
        }
        Auth::logout();
        return redirect('/login');
    }
}
