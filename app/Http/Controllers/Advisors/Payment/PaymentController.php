<?php

namespace App\Http\Controllers\Advisors\Payment;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function RequestWithdraw(Request $request)
    {
        $Advisor = Auth::guard('advisor')->User();
        $AdvisorPayment = $Advisor->Payment();
        $trxs = \App\Models\Transaction::where(['advisor_id' => $Advisor->id, 'status' => 'true'])->where('type', '!=', 'plan')->get();

        $trxsblock = 0;
        if ($trxs) {
            foreach ($trxs as $tx) {

                if ($tx->Conversation) {
                    if ($tx->Conversation->status != 'done') {

                        $trxsblock += $tx->price;
                    }
                }
            }
        }
        $price = $trxs->sum('price') - $AdvisorPayment->sum('amount') - $trxsblock;
        if ($request->price <= $price) {
            Payment::create([
                'advisor_id' => $Advisor->id,
                'status' => 'to_do',
                'card' => $request->card,
                'amount' => $request->price,
            ]);
            FlashMessage::set('success', 'درخواست ثبت شد');
            return back();
        } else {
            FlashMessage::set('error', 'مبلغ درخواست شده صحیح نیست');
            return back();
        }
    }
}
