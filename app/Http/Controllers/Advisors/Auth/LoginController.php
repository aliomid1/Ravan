<?php

namespace App\Http\Controllers\Advisors\Auth;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Advisors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login()
    {
        if(auth()->guard('advisor')->user()){
            return redirect(route('Advisors.Dashboard'));
        }
        return view('Advisors.Main.Login');
    }

    function AdvisorLoginpost(Request $request)
    {
        $Advisor =  Advisors::where('username', $request->username)->where('password',$request->password)->first();
        $guard = 'advisor';
        if ($Advisor) {
            Auth::guard('advisor')->login($Advisor);
            return redirect(route('Advisors.Dashboard'));
        } else {
            FlashMessage::set('warning','نام کاربری یا کلمه عبور اشتباه است');
         return back();
        }
    }

}
