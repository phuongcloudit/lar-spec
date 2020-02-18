<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    
    // protected $redirectTo = '/admin/dashboard';
   
    protected function redirectTo(){
        if(Auth::user()->usertype == 'admin'){
            return 'admin/dashboard';
        }
        else{
            return 'home';
        }
    }

}
