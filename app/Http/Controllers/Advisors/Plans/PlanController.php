<?php

namespace App\Http\Controllers\Advisors\Plans;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Plan;
use App\Models\PlansAdvisor;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Larabookir\Gateway\Exceptions\RetryException;
use Larabookir\Gateway\Gateway;

class PlanController extends Controller
{
    public function Buy($id)
    {
        $plan = Plan::find($id);
        if ($plan) {

            try {
                $gateway = Gateway::make('payir');

                $gateway->setCallback(route('VrifyPlanBuy'));

                $price = (int)$plan->price;

                $gateway->price($price)->ready();

                $refId =  $gateway->refId();
                $transID = $gateway->transactionId();
                Transaction::create([
                    'advisor_id' => Auth::guard('advisor')->user()->id,
                    'price' => $plan->price,
                    'status' => 'false',
                    'plan_id' => $plan->id,
                    'transid' => $transID,
                    'refid' => $refId,
                    'type' => 'plan'
                ]);;
                return $gateway->redirect();
            } catch (\Exception $e) {
                FlashMessage::set('warning', $e->getMessage() . "<br>");
                return back();
            }
            return back();
        } else {
            FlashMessage::set('error', 'درخواست کامل نیست');
            return back();
        }
    }
    public function VrifyPlanBuy()
    {
        try {
            $gateway = Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
            $transaction = Transaction::where(['refid' => $refId, 'type' => 'plan'])->first();

            $transaction->update([
                'status' => 'true',
                'cardnumber' => $cardNumber,
                'trackingcode' => $trackingCode
            ]);
            $plan = Plan::find($transaction->plan_id);
            PlansAdvisor::create([
                'user_id' => Auth::guard('advisor')->user()->id,
                'time' => Carbon::now()->addDays($plan->time)
            ]);
            Auth::guard('advisor')->user()->update(['vip'=>'1']);
            FlashMessage::set('success', 'پلن برای شما فعال شد');
            return redirect(route('Advisors.Dashboard'));
        } catch (RetryException $e) {
            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Advisors.BuyPlan'));
        } catch (\Exception $e) {
            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Advisors.BuyPlan'));
        }
    }
}
