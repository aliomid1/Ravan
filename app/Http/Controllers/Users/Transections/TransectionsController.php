<?php

namespace App\Http\Controllers\Users\Transections;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larabookir\Gateway\Exceptions\RetryException;
use Larabookir\Gateway\Gateway;

class TransectionsController extends Controller
{
    public function AddWallet(Request $request)
    {
        if ($request->amount > 0) {

            try {
                $gateway = Gateway::make('payir');
                $gateway->setCallback(route('VrifyAddWallet'));
                $price = (int)$request->amount;
                $gateway->price($price)->ready();
                return $gateway->redirect();
            } catch (\Exception $e) {
                FlashMessage::set('warning', $e->getMessage() . "<br>");
                return back();
            }
        } else {
            FlashMessage::set('error', 'مبلغ درخواست شده صحیح نیست');
            return back();
        }
    }

    public function VrifyAddWallet()
    {
        try {
            $gw = Gateway::verify();
            $amount = $gw->getPrice() / 10;
            Wallet::create([
                'user_id' => Auth::guard('web')->user()->id,
                'amount' => $amount,
                'type' => 'deposit'
            ]);
            FlashMessage::set('success', 'کیف پول شما شارژ شد');
            return redirect(route('Users.Transactions'));
        } catch (RetryException $e) {
            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Users.Transactions'));
        } catch (\Exception $e) {
            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Users.Transactions'));
        }
    }
}
