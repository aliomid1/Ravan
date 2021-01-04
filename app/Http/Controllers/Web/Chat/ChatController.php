<?php

namespace App\Http\Controllers\Web\Chat;

use App\Http\Controllers\Controller;
use App\Models\Advisors;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\Settings;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function CreateChat($id, $typepay, $payment, $subject)
    {
        if ($id) {
            $advisor = Advisors::find($id);
            $user = Auth::guard('web')->user();

            $encrypteddata = (new Encrypter(env('APP_CIPHER_SERVERKEY')))->encryptString(json_encode([
                'user_id' => $user->id,
                'expert_id' => $advisor->id,
                'starter' => 'user'
            ]));
            $settings = Settings::find(1);
            $profileAdvisor = $advisor->Profile ? $advisor->Profile->url : '';
            $profileUser = $user->Image ? $user->Image->url : '';
            $time = $advisor->time_of_one_consultation ? $advisor->time_of_one_consultation : $settings->time_default;
            $price = $advisor->price ? $advisor->price : $settings->price_default;
            $price = ($time * $price);
            $price = $price + (($price * $settings->percent) / 100);
            Conversation::create([
                'user_id' => $user->id,
                'advisor_id' => $advisor->id,
                'type' => 'online',
                'time' => $time,
                'price' => $price,
                'subject' => $subject,
                'status' => 'off',
                'start_at' => Carbon::now()
            ]);
            $time = (60 * $time);
            $chat = Chat::create([
                'status' => false,
                'used' => false,
                'user_id' => $user->id,
                'expiretime' => $time,
                'expert_id' => $advisor->id,
                'user_name' => $user->fullname,
                'expert_name' =>  $advisor->name,
                'user_profile' => $profileUser,
                'advisor_profile' => $profileAdvisor,
                'HasVoiceCall' => true,
                'HasVideoCall' => true,
                'encrypt' => $encrypteddata
            ]);

            if ($payment == 'true') {
                $transaction = Transaction::create([
                    'chat_id' => $chat->id,
                    'user_id' => $user->id,
                    'advisor_id' => $advisor->id,
                    'price' => $price,
                    'type' => 'chat',
                    'status' => 'true'
                ]);
            } else {
                $transaction = Transaction::create([
                    'chat_id' => $chat->id,
                    'user_id' => $user->id,
                    'advisor_id' => $advisor->id,
                    'price' => $price,
                    'type' => 'chat',
                    'status' => 'false'
                ]);
            }

            return redirect(route('Web.CheckPaymentChat', ['id' => $transaction->id, 'typepay' => $typepay]));
        } else {
            return back();
        }
    }

    public function StartChat($id)
    {

        $chat = Chat::find($id);
        $user = Auth::guard('web')->user();
        $advisor = Auth::guard('advisor')->user();
        $USerR = [];
        $typesender = '';

        if (!$user) {
            if ($advisor) {
                $USerR = $advisor;
                $typesender = 'advisor';
            } else {
                return redirect(route('Web.index'));
            }
        } else {
            $USerR = $user;
            $typesender = 'user';
        }
       
        if ($chat && $USerR) {
            if ($USerR->id == $chat->user_id || $USerR->id == $chat->expert_id) {
                return redirect('http://192.168.1.105:81/chat/start/' . $chat->id . '/' . $typesender . '/' . $chat->encrypt);
            }
            return redirect(route('Web.index'));
        } else {
            return redirect(route('Web.index'));
        }
    }

    public function CheckChatData($id, $sender)
    {

        $chat = Chat::find($id);
        if ($chat) {
            return response([
                'status' => $chat->status,
                'user_id' => $chat->user_id,
                'sender' => $sender,
                'expiretime' => $chat->expiretime,
                'expert_id' => $chat->expert_id,
                'user_name' => $chat->user_name,
                'expert_name' =>  $chat->expert_name,
                'user_profile' => asset($chat->user_profile),
                'advisor_profile' => asset($chat->advisor_profile),
                'HasVoiceCall' => $chat->HasVoiceCall,
                'HasVideoCall' => $chat->HasVideoCall
            ]);
        } else {
            return response([
                'status' => false,
            ]);
        }
    }

    public function CheckPaymentChat($id, $typepay)
    {
        $transaction = Transaction::find($id);

        if ($transaction) {
            if ($transaction->status == 'true') {
                $chat = Chat::find($transaction->chat_id);
                if ($chat) {
                    if (!$chat->used) {
                        $chat->update(['status' => true, 'used' => true]);
                        return redirect(route('Web.STARTChat', $chat->id));
                    } else {
                        return redirect(route('Web.index'));
                    }
                } else {
                    return redirect(route('Web.index'));
                }
            } else {
                return redirect(route('ChatPayment', ['typepayment' => $typepay, 'tranid' => $transaction->id]));
            }
        } else {
            return redirect(route('Web.index'));
        }
    }
}
