<?php

namespace App\Http\Controllers\Admins\Support;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\SupportMessage;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function Show($id)
    {
        return view('Admins.Support.message', compact('id'));
    }

    public function Replay(Request $request)
    {

        if ($request->message) {
            $res = SupportMessage::create($request->except('_token'));

            if ($res) {
                Support::where('id', $request->support_id)->update(['status' => 'ok']);
                FlashMessage::set('success', 'پاسخ ثبت شد');
                return back();
            } else {
                FlashMessage::set('error', 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set('error', 'پاسخ را کامل کنید');
            return back();
        }
    }
    public function DeleteMessage(Request $request)
    {
        if ($request->id) {
            $res2 =  SupportMessage::where('id', $request->id)->delete();
            if ($res2) {
                return true;
            } else {
                return 'درخواست کامل نیست';
            }
        } else {
            return 'درخواست کامل نیست';
        }
    }
    public function destroy($id)
    {
        if ($id) {
            $res = Support::where('id', $id)->delete();
            $res2 =  SupportMessage::where('support_id', $id)->delete();
            if ($res && $res2) {
                FlashMessage::set(true, 'حذف انجام شد');
                return back();
            } else {
                FlashMessage::set(false, 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set(false, 'درخواست ناقص');
            return back();
        }
    }
}
