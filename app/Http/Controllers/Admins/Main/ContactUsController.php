<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function edit()
    {
        $ContactUs = ContactUs::first();
        return view('Admins.ContactUs.edit' , compact('ContactUs'));
    }



    public function update(Request $request)
    {
            $ContactUs = ContactUs::first();
            // dd($request->all());
            $res = $ContactUs->update($request->only(['email', 'phone', 'address']));
            if ($res) {
                FlashMessage::set('success', 'بروز رسانی انجام شد');
                return back();
            } else {
                FlashMessage::set('error', 'مشکلی پیش امده');
                return back();
            }
    }
}
