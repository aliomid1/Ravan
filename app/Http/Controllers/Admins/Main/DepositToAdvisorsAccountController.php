<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Payment;
use Illuminate\Http\Request;

class DepositToAdvisorsAccountController extends Controller
{
    public function index()
    {
        return view('Admins.DepositToAdvisorsAccount.index');
    }
    public function status(Request $request)
    {
        $pay = Payment::find($request->id);
        if ($pay) {
            $pay->update([
                'status' => 'done',
                'code_ref' => $request->code_ref
            ]);
            FlashMessage::set('success', 'درخواست ثبت شد');
            return back();
        } else {
            FlashMessage::set('error', 'درخواست معتبر نیست ');
            return back();
        }
    }
}
