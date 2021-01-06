<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function General(Request $request)
    {
        $settings = Settings::first();

        if ($request->title) {
            $settings->update($request->except(['_token', 'logo']));
            if ($request->logo) {
                $settings->update(['logo' => ImageUploader::upload($request->logo, 'Logo/', null, $settings->logo)]);
            }
            FlashMessage::set('success', 'اطلاعات ثبت شد');
            return back();
        } else {
            FlashMessage::set('error', 'درخواست کامل نیست');
            return back();
        }
    }

    public function App(Request $request)
    {
        $this->put_permanent_env('ZARINPAL_MERCHANT', $request->zarinpal);
        $this->put_permanent_env('PAYIR_MERCHANT', $request->payir);
        $this->put_permanent_env('APP_IDPAY', $request->idpay);
        $this->put_permanent_env('MELIPAYAMAKUSERNAME', $request->usernaempayamak);
        $this->put_permanent_env('MELIPAYAMAKPASSWORD', $request->passwordpayamak);
        if ($request->profile) {
            Auth::guard('admin')->user()->update(['profile' => ImageUploader::upload($request->profile, 'Admin/', null, Auth::guard('admin')->user()->profile)]);
        }
        Auth::guard('admin')->user()->update(
            [
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]
        );
        FlashMessage::set('success', 'اطلاعات ثبت شد');
        return back();
    }
}
