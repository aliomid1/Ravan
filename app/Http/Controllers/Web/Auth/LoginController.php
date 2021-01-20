<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\lib\Messages\FlashMessage;
use App\Models\Settings;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Melipayamak\MelipayamakApi;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        if (isset($request->advisor)) {
            Session::put('AdvisorRedireact', $request->advisor);
        }
        if (auth()->user()) {
            if (!empty(auth()->user()->password)) {
                return redirect(route('Users.Dashboard'));
            } else {
                FlashMessage::set('warning', 'براي گرفتن مشاوره، تكميل پروفايل الزامي مي باشد.');
                return redirect(route('Users.Profile'));
            }
        }
        Session::put('CallerId', $request->CallerId);
        return view('Web.Main.sign-in');
    }
    public function LoginPassword(Request $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                if (!empty(auth()->user()->password)) {
                    return redirect(route('Users.Dashboard'));
                } else {
                    FlashMessage::set('warning', 'براي گرفتن مشاوره، تكميل پروفايل الزامي مي باشد.');
                    return redirect(route('Users.Profile'));
                }
            }
        }
        FlashMessage::set('warning', 'اطلاعات صحیح نیست');
        return back();
    }
    public function Anonymous(Request $request)
    {
        $settings = Settings::first();
        if ($request->mobile) {
            if ($settings->type_signUp_users == 'on') {
                $check = User::where('mobile', $request->mobile)->first();
                if ($check) {
                    FlashMessage::set('warning', 'با این شماره قبلا  ثبت نام شده است');
                    return back();
                }
                $user =  User::create(['fullname' => 'کاربرناشناس', 'username' => 'Anonymous' . rand(00000000, 99999999), 'mobile' => $request->mobile]);
                $data = [
                    'fullname' => $user->fullname,
                    'username' => $user->username,
                    'mobile' => $user->mobile,
                    'id' => $user->id,
                ];
                Session::put('anonymous', $data);
                return redirect(route('Web.ConsultantList'));
            } else {
                return back();
            }
        } else {
            FlashMessage::set('warning', 'شماره موبایل خود را وارد کنید');
            return back();
        }
    }
    function CheckUser(Request $request)
    {
        if ($request->mobile) {
            $test = true;
            $settings = Settings::first();
            $mobile = $request->mobile;
            $user =  User::where('mobile', $mobile)->first();
            if (!$user) {
                $user = User::create([
                    'fullname' => 'کاربر ناشناس',
                    'mobile' => $request->mobile,
                    'username' => rand(10000000, 99999999)
                ]);
            }
            $code = rand(00000, 99999);
            $message = 'کد ورود شما به ' . $settings->title . ':' . $code;
            Session::put('usernw', $user->id);
            Session::put('codesms', 12345);
//            $sendsms = $this->SMS($mobile, $message);
            if ($code) {
                return true;
            } else {
                return true;
            }
        } else {
            return 'شماره تلفن خود را وارد کنید';
        }
    }

    function CheckCode(Request $request)
    {
        $settings = Settings::first();
        if ($request->certif_code == Session::get('codesms')) {

            $user = User::find(Session::get('usernw'));
            Auth::login($user);
            if (Session::get('CallerId')) {
                DB::table('wallets')->insert([
                    [
                        'user_id' => Session::get('CallerId'),
                        'amount' => $settings->gift_default,
                        'type' => 'friend',
                    ],
                ]);
            }
            if (!empty(auth()->user()->password)) {
                return redirect(route('Users.Dashboard'));
            } else {
                FlashMessage::set('warning', 'براي گرفتن مشاوره، تكميل پروفايل الزامي مي باشد.');
                return redirect(route('Users.Profile'));
            }
        } else {

            FlashMessage::set('warning', 'کد وارد شده اشتباه است');
            return back();
        }
    }
}
