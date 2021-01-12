<?php

namespace App\Http\Controllers\Users\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Main\Profile\UpdateRequest;
use App\lib\Messages\FlashMessage;
use App\Mail\VerifyEmail;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function Update(UpdateRequest $request)
    {

        $user = auth()->user();
        // dd($request->password);
        if ($request->password) {
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
            $user->update($request->only(['password']));
        }

        if (empty($user->password)) {
            FlashMessage::set('warning', 'لطفا پسورد خود را تعیین کنید');
            return back();
        }

        $user->update($request->except(['_token','password','password_confirmation','mobile','email']));


        $settings = Settings::first();
        if ($settings->verify_email=='off') {
            $user->update(['email'=>$request->email]);
        }



        

        FlashMessage::set('success', 'اطلاعات با موفقيت ويرايش شد');
        return back();
    }
    public function SendCodeEmail(Request $request)
    {
        $User = Auth::guard('web')->user();
        if ($User) {
            if ($request->email) {
                $code = rand(00000, 99999);
                Session::put('verifyemail', $code);
                $User->update(['verify_email'=>$code,'email'=>$request->email]);
                Mail::to($request->email)->send(new VerifyEmail());
                return true;
            } else {
                return 'ایمیل را وارد کنید';
            }
        } else {
            return false;
        }
    }
    public function VerifyEmail(Request $request)
    {
        $User = Auth::guard('web')->user();
        if ($User) {
            if ($request->code==$User->verify_email) {
                $User->update(['verify_email'=>'ok']);
                return true;
            } else {
                return 'کد وارد شده صحیح نیست';
            }
        } else {
            return false;
        }
    }
}
