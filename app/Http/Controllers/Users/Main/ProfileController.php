<?php

namespace App\Http\Controllers\Users\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Main\Profile\UpdateRequest;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Mail\VerifyEmail;
use App\Models\Image;
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
    public function ImageUpdate(Request $request)
    {
        $user = auth()->user();
        $user_image = Image::where('type' , 'user')->where('item_id' , $user->id)->first();
        if ($user_image) {
            $user_image->update(['url' => ImageUploader::upload($request->file('image'), 'Users/Profile/', null, $user_image->url)]);
        } else{
            $user_image = Image::create([
                'type' => 'user',
                'item_id' => $user->id, 
                'url' =>  ImageUploader::upload($request->file('image'), 'Advisors/Profile/'),  
            ]);
        }
        if ($user_image) {
            return $user_image->url;
        } else {
            return 'false';
        }
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
