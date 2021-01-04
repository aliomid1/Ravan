<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Advisors;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Larabookir\Gateway\Gateway;
use \Larabookir\Gateway\Exceptions\RetryException;

class PaymentController extends Controller
{
    public function SubmitPaymentType(Request $request)
    {

        $payment = 'false';

        $advisor = Advisors::find($request->id);
        if ($advisor) {
            $education = json_decode($advisor->education);
            if (!is_array($education) && !is_object($education)) {
                $education = [];
            }

            if ($request->type != 'online') {
                $ConsultationsTimes = json_decode($advisor->consultations_times, true);

                $date = '';
                if ($ConsultationsTimes['Sliced'][str_replace('-', '/', $request->date)][$request->key]['Status'] != '1') {
                    FlashMessage::set('warning', 'زمان انتخاب شده صحیح نیست');
                    return back();
                } else {
                    $Jalalian = str_replace('-', '/', $request->date) . ' ' . $ConsultationsTimes['Sliced'][str_replace('-', '/', $request->date)][$request->key]['Time'];
                    $date = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d H:i', $Jalalian);
                    Session::put('convvtt', ['id' => $advisor->id, 'data' => json_encode($ConsultationsTimes)]);
                    $ConsultationsTimes['Sliced'][str_replace('-', '/', $request->date)][$request->key]['Status'] = "0";
                    $advisor->update(['consultations_times' => json_encode($ConsultationsTimes)]);
                }
            }
            if ($request->typepayment == 'wallet') {

                $settings = Settings::find(1);
                $time = $advisor->time_of_one_consultation ? $advisor->time_of_one_consultation : $settings->time_default;
                $price = $advisor->price ? $advisor->price : $settings->price_default;
                $price = ($time * $price);
                $price = $price + (($price * $settings->percent) / 100);

                if (Auth::guard('web')->user()->Wallet->sum('amount') >= $price) {
                    Wallet::create([
                        'user_id' => Auth::guard('web')->user()->id,
                        'amount' => -$price,
                        'type' => 'withdraw'
                    ]);
                    $payment = 'true';
                }
            }
            switch ($request->type) {
                case 'online':
                    return redirect(route(
                        'Web.CreateChat',
                        [
                            'id' => $request->id,
                            'typepay' => $request->typepayment,
                            'payment' => $payment,
                            'subject' => $request->subject
                        ]
                    ));
                    break;
                case 'in':
                    return redirect(route(
                        'Web.Reservation',
                        [
                            'id' => $request->id,
                            'typepay' => $request->typepayment,
                            'subject' => $request->subject,
                            'date' => $date,
                            'type' => $request->type,
                            'payment' => $payment
                        ]
                    ));
                    break;
                case 'out':
                    return redirect(route(
                        'Web.Reservation',
                        [
                            'id' => $request->id,
                            'typepay' => $request->typepayment,
                            'subject' => $request->subject,
                            'date' => $date,
                            'type' => $request->type,
                            'payment' => $payment
                        ]
                    ));
                    break;
            }
        } else {
            FlashMessage::set('warning', 'درخواست کامل نیست');
            return back();
        }
    }
    public function Payment($tranid, $typepayment)
    {

        $transaction = Transaction::find($tranid);
        if ($transaction) {

            Session::put('paytransid', $transaction->id);
            Session::put('paytypee', $typepayment);

            if ($typepayment == 'idpay') {
                $params = array(
                    'order_id' => $transaction->id,
                    'amount' => (int) $transaction->price,
                    'callback' => route('BankResponse2'),
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
                $transaction->update(['transid' => $result['id']]);
                return redirect($result['link']);
            } else {
                try {
                    $gateway = Gateway::make($typepayment);
                    $gateway->setCallback(route('BankResponse'));
                    $price = (int)$transaction->price;
                    $gateway->price($price)->ready();
                    $refId =  $gateway->refId();
                    $transID = $gateway->transactionId();
                    $transaction->update([
                        'transid' => $transID,
                        'refid' => $refId,
                    ]);
                    return $gateway->redirect();
                } catch (\Exception $e) {

                    FlashMessage::set('warning', $e->getMessage() . "<br>");
                    return redirect(route('Web.index'));
                }
            }
        }
    }
    public function Response()
    {

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

            return redirect(route('Web.CheckPaymentChat', ['id' => $transaction->id, 'typepay' => $paytypee]));
        } catch (RetryException $e) {

            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Web.index'));
        } catch (\Exception $e) {
            FlashMessage::set('warning', $e->getMessage() . "<br>");
            return redirect(route('Web.index'));
        }
    }
    public function ResponseIdpay(Request $request)
    {
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
                    $transaction->update([
                        'status' => 'true',
                        'trackingcode' => $result['track_id']
                    ]);
                    return redirect(route('Web.CheckPaymentChat', ['id' => $transaction->id, 'typepay' => $paytypee]));
                } else {
                    FlashMessage::set('warning', 'پرداخت انجام نشد');
                    return redirect(route('Web.index'));
                }
            } else {

                FlashMessage::set('warning', $result['error_message']);
                return redirect(route('Web.index'));
            }
        } catch (\Exception $e) {

            FlashMessage::set('warning', $e->getMessage());
            return redirect(route('Web.index'));
        }
    }
}
