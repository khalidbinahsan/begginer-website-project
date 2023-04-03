<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAdmin;

class LoginController extends Controller
{
    function loginIndex(){
        return view('Login');
    }
    function onLogin(Request $request){
       $email = $request->input('email');
       $password = $request->input('password');
       $userCount = UserAdmin::where('email', '=', $email)->where('password', '=', $password)->count();
       if($userCount==1){
        $request->session()->put('email', $email);
        return 1;
       } else {
        return 0;
       }
    }
    function onLogOut(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
