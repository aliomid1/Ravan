<?php

namespace App\Http\Controllers\Web\Main;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Advisors;
use App\Models\Conversation;
use App\Models\Settings;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larabookir\Gateway\Exceptions\RetryException;
use Illuminate\Support\Facades\Session;
use Larabookir\Gateway\Gateway;

class ReservationController extends Controller
{
    public function Reservation(Request $request)
    {

        if ($request->id) {

            $advisor = Advisors::find($request->id);
            $user = Auth::guard('web')->user();
            $settings = Settings::find(1);
            $time = $advisor->time_of_one_consultation ? $advisor->time_of_one_consultation : $settings->time_default;
            $price = $advisor->price ? $advisor->price : $settings->price_default;
            $price = ($time * $price);
            $price = $price + (($price * $settings->percent) / 100);
            $code = rand(00000, 99999);
            $trx =  Transaction::create([
                'user_id' => $user->id,
                'advisor_id' => $advisor->id,
                'price' => $price,
                'type' => $request->type,
                'status' => 'false'
            ]);
            $con = Conversation::create([
                'user_id' => $user->id,
                'advisor_id' => $request->id,
                'type' => $request->type,
                'time' => $time,
                'price' => $price,
                'status' => 'to_do',
                'code' => $code,
                'subject' => $request->subject,
                'start_at' => $request->date
            ]);
            if($request->payment=='true'){
                $trx->update([
                    'status' => 'true',
                ]);
                if (is_object($con)) {
                    $con->update(['status' => 'to_do']);
                }
                FlashMessage::set('success', 'مشاور شما رزرو شد');
                return redirect(route('Users.Conversations'));
            }else{

                Session::put('conid', $con->id);
                Session::put('paytransid', $trx->id);
                Session::put('paytypee', $request->typepayment);

                if ($request->typepayment == 'idpay') {
                    $params = array(
                        'order_id' => $trx->id,
                        'amount' => (int) $trx->price,
                        'callback' => route('BankResponse2Res'),
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'X-API-KEY:' . env('APP_IDPAY'),
                        'X-SANDBOX: 1'
                    ));

                    $result = curl_exec($ch);
                    $result = json_decode($result, true);
                    curl_close($ch);
                    $trx->update(['transid' => $result['id']]);
                    return redirect($result['link']);
                } else {
                    try {
                        $gateway = Gateway::make($request->typepayment);
                        $gateway->setCallback(route('BankResponseRes'));
                        $price = (int)$trx->price;
                        $gateway->price($price)->ready();
                        $refId =  $gateway->refId();
                        $transID = $gateway->transactionId();
                        $trx->update([
                            'transid' => $transID,
                            'refid' => $refId,
                        ]);
                        return $gateway->redirect();
                    } catch (\Exception $e) {
                        if (is_object($con)) {
                            $con->delete();
                        }
                        $datarev = Session::get('convvtt');
                        if ($datarev) {
                            $advisor = Advisors::find($datarev['id']);
                            if ($advisor) {
                                $advisor->update(['consultations_times' => $datarev['data']]);
                            }
                        }
                        FlashMessage::set('warning', $e->getMessage() . "<br>");
                        return redirect(route('Web.ConsultantList'));
                    }
                }
            }

        } else {
            return redirect(route('Web.ConsultantList'));
        }
    }


    public function Response()
    {
        $con = Session::get('conid');
        $con = Conversation::find($con);
        try {
            $gateway = Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
            $transaction = Session::get('paytransid');
            $paytypee = Session::get('paytypee');
            $transaction = Transaction::find($transaction);
            if (!$transaction) {
                $transaction = Transaction::where(['refid' => $refId])->first();
            }
            $transaction->update([
                'status' => 'true',
                'cardnumber' => $cardNumber,
                'trackingcode' => $trackingCode
            ]);
            if (is_object($con)) {
                $con->update(['status' => 'to_do']);
            }

            FlashMessage::set('success', 'مشاور شما رزرو شد');
            return redirect(route('Users.Conversations'));
        } catch (RetryException $e) {
            if (is_object($con)) {
                $con->delete();
            }
            $datarev = Session::get('convvtt');
            if ($datarev) {
                $advisor = Advisors::find($datarev['id']);
                if ($advisor) {
                    $advisor->update(['consultations_times' => $datarev['data']]);
                }
            }
            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Web.ConsultantList'));
        } catch (\Exception $e) {
            if (is_object($con)) {
                $con->delete();
            }
            $datarev = Session::get('convvtt');
            if ($datarev) {
                $advisor = Advisors::find($datarev['id']);
                if ($advisor) {
                    $advisor->update(['consultations_times' => $datarev['data']]);
                }
            }
            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Web.ConsultantList'));
        }
    }
    public function ResponseIdpay(Request $request)
    {
        $con = Session::get('conid');
        $con = Conversation::find($con);
        try {
            $paytypee = 'idpay';
            $transaction = Transaction::find($request->order_id);
            $params = array(
                'id' => $request->id,
                'order_id' => $request->order_id,
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-API-KEY:' . env('APP_IDPAY'),
                'X-SANDBOX: 1',
            ));
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            curl_close($ch);


            if (array_key_exists('status', $result)) {
                if ($result['status'] == '100' || $result['status'] == '200') {

                    if (is_object($con)) {
                        $con->update(['status' => 'to_do']);
                    }
                    $transaction->update([
                        'status' => 'true',
                        'trackingcode' => $result['track_id']
                    ]);
                    FlashMessage::set('success', 'مشاور شما رزرو شد');
                    return redirect(route('Users.Conversations'));
                } else {
                    $datarev = Session::get('convvtt');
                    if ($datarev) {
                        $advisor = Advisors::find($datarev['id']);
                        if ($advisor) {
                            $advisor->update(['consultations_times' => $datarev['data']]);
                        }
                    }
                    if (is_object($con)) {
                        $con->delete();
                    }
                    FlashMessage::set('warning', 'پرداخت انجام نشد');
                    return redirect(route('Web.ConsultantList'));
                }
            } else {
                if (is_object($con)) {
                    $con->delete();
                }
                $datarev = Session::get('convvtt');
                if ($datarev) {
                    $advisor = Advisors::find($datarev['id']);
                    if ($advisor) {
                        $advisor->update(['consultations_times' => $datarev['data']]);
                    }
                }
                FlashMessage::set('warning', $result['error_message']);
                return redirect(route('Web.ConsultantList'));
            }
        } catch (\Exception $e) {
            if (is_object($con)) {
                $con->delete();
            }
            $datarev = Session::get('convvtt');
            if ($datarev) {
                $advisor = Advisors::find($datarev['id']);
                if ($advisor) {
                    $advisor->update(['consultations_times' => $datarev['data']]);
                }
            }
            FlashMessage::set('warning', $e->getMessage());
            return redirect(route('Web.ConsultantList'));
        }
    }
}
