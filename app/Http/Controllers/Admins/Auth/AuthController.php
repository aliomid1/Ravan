<?php

namespace App\Http\Controllers\Admins\Auth;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('Admins.Auth.index');
    }
    public function CheckUser(Request $request)
    {

        $Admin = Admin::where('username', $request->username)->where('password', md5($request->password))->first();
        if ($Admin) {
                Auth::guard("admin")->loginUsingId($Admin->id);
                FlashMessage::set('success', 'به پنل ادمین خوش آمدید');
                return redirect(route('Admins.Dashboard'));
        } else {
            FlashMessage::set('error', 'کاربری با این مشخصات یافت نشد');
            return back();
        }
    }
}
