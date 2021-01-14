<?php

namespace App\Http\Controllers\Admins\Advisors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Advisors\AddAdvisorRequest;
use App\Http\Requests\Advisor\Main\Profile\UpdateRequest;
use App\lib\File\BaseUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Advisors;
use App\Models\Image;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdvisorsController extends Controller
{
    public function store(AddAdvisorRequest $request)
    {
        $networks = array();
        if ($request->telegram) {
            $networks['telegram'] = $request->telegram;
        }
        if ($request->instagram) {
            $networks['instagram'] = $request->instagram;
        }
        if ($request->whatsapp) {
            $networks['whatsapp'] = $request->whatsapp;
        }
        if ($request->facebook) {
            $networks['facebook'] = $request->facebook;
        }
        if ($request->linkdin) {
            $networks['linkdin'] = $request->linkdin;
        }
        if ($request->mailito) {
            $networks['mailito'] = $request->mailito;
        }
        $networks = serialize($networks);
        $request->request->add([
            'networks' => $networks,
            'password' => Hash::make($request->password),
        ]);
        $settings = Settings::first();
        $advisor = Advisors::create($request->only(['name', 'mobile', 'email', 'tel', 'address', 'username', 'password', 'networks',]));
        $message = $settings->textmessagesignup . "\n" .
            ' لینک ورود ' . route('Advisors.auth.Login') . "\n" .
            'نام کاربری' . $advisor->username . "\n" .
            'کلمه عبور' . $request->password;
        $this->SMS($advisor->mobile, $message);
        FlashMessage::set('success', 'اطلاعات با موفقيت ويرايش شد');
        return back();
    }



    public function edit($id)
    {
        if ($id) {
            $advisor = Advisors::find($id);
            return view('Admins.Advisors.EditAdvisor', $advisor);
        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }



    public function update(UpdateRequest $request, $id)
    {
        // dd('hi');
        $Advisor = Advisors::find($id);
        // dd($request->password);
        if ($request->password) {
            // dd($Advisor);
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
            $Advisor->update($request->only(['password']));
        }

        $networks = array();
        if ($request->telegram) {
            $networks['telegram'] = $request->telegram;
        }
        if ($request->instagram) {
            $networks['instagram'] = $request->instagram;
        }
        if ($request->whatsapp) {
            $networks['whatsapp'] = $request->whatsapp;
        }
        if ($request->facebook) {
            $networks['facebook'] = $request->facebook;
        }
        if ($request->linkdin) {
            $networks['linkdin'] = $request->linkdin;
        }
        if ($request->mailito) {
            $networks['mailito'] = $request->mailito;
        }
        $networks = serialize($networks);
        $Advisor->update(['networks' => $networks]);
        // dd(unserialize($Advisor->networks));

        $Advisor->update($request->only(['name', 'networks', 'mobile', 'email', 'tel', 'address', 'username',]));
        FlashMessage::set('success', 'اطلاعات با موفقيت ويرايش شد');
        return back();
    }



    public function destroy(Request $request)
    {

        if ($request->id) {
            $advisor = Advisors::find($request->id);
            if ($advisor) {
                $image = Image::where('item_id', $advisor->id)->where('type', 'profile_advisor')->first();
                if ($image) {
                    BaseUploader::delete($image->url);
                    $image->delete();
                }
                $advisor->delete();
                return true;
            } else {
                return 'درخواست کامل نبود';
            }
        } else {
            return 'درخواست کامل نبود';
        }
    }
}
