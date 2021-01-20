<?php

namespace App\Http\Controllers\Web\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\lib\Messages\FlashMessage;
use App\Models\Advisors;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\Settings;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;

class ChatController extends Controller
{
    public function CreateChat($id, $typepay, $payment, $subject)
    {
        if ($id) {
            $advisor = Advisors::find($id);
            $user = Auth::guard('web')->user();
            $code = rand(00000, 99999);
            $settings = Settings::find(1);
            $time = $advisor->time_of_one_consultation ? $advisor->time_of_one_consultation : $settings->time_default;
            $price = $advisor->price ? $advisor->price : $settings->price_default;
            $price = ($time * $price);
            $price = $price + (($price * $settings->percent) / 100);

            $conversation = Conversation::create([
                'user_id' => $user->id,
                'advisor_id' => $advisor->id,
                'type' => 'chat',
                'time' => $time,
                'price' => $price,
                'subject' => $subject,
                'status' => 'doing',
                'code' => $code,
                'start_at' => Carbon::now()
            ]);
            $data = [
                'user' => $user,
                'advisor' => $advisor,
                'conversation' => $conversation
            ];
            $chat = $this->NewChat($data);
            if ($payment == 'true') {
                $transaction = Transaction::create([
                    'chat_id' =>  $conversation->id,
                    'user_id' => $user->id,
                    'advisor_id' => $advisor->id,
                    'price' => $price,
                    'type' => 'chat',
                    'status' => 'true'
                ]);
            } else {
                $transaction = Transaction::create([
                    'chat_id' =>  $conversation->id,
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
        $settings = Settings::find(1);
        if (!$user) {
            if ($advisor) {
                $USerR = $advisor;
                $typesender = 'advisor';
            } else {
                FlashMessage::set('error', 'درخواست کامل نیست');
                return redirect(route('Web.index'));
            }
        } else {
            $USerR = $user;
            $typesender = 'user';
        }

        if ($chat && $USerR) {

            if ($USerR->id == $chat->user_id || $USerR->id == $chat->expert_id) {

                try {
                    return redirect($settings->url_chat . '/chat/start/' . $chat->id . '/' . $typesender . '/' . $chat->encrypt);
                } catch (Exception $e) {
                    FlashMessage::set('error', $e->getMessage());
                    return redirect(route('Web.index'));
                }
            } else {

                FlashMessage::set('error', 'درخواست کامل نیست');
                return redirect(route('Web.index'));
            }
        } else {
            FlashMessage::set('error', 'درخواست کامل نیست');
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
                'conversation_id' => $chat->conversation_id,
                'sender' => $sender,
                'expiretime' => $chat->expiretime,
                'expert_id' => $chat->expert_id,
                'user_name' => $chat->user_name,
                'expert_name' =>  $chat->expert_name,
                'user_profile' => asset($chat->user_profile),
                'advisor_profile' => asset($chat->advisor_profile),
                'RouteAdvisor' => route('Advisors.Chats'),
                'RouteUser' => route('Users.Chats'),
                'RouteMain' => route('Web.index'),
                'HasVoiceCall' => $chat->HasVoiceCall,
                'HasVideoCall' => $chat->HasVideoCall
            ]);
        } else {
            return response([
                'status' => false,
            ]);
        }
    }
    public function CheckEndChat($id, $time, $type)
    {
        $settings = Settings::find(1);
        $conversation = Conversation::find($id);
        $timeac = 0;
        if ($type == 'user') {
            $timeac = $conversation->time - $settings->timeleftuser;
        } else {
            $timeac = $conversation->time - $settings->timeleftadvisor;
        }
        $time = $time / 60;
        if ($time <= $timeac) {
            $conversation->update(['status' => 'not' . $type == 'user' ? "advisor" : "user"]);
            return response([
                'status' => 200
            ]);
        } else {
            return response([
                'status' => 0
            ]);
        }
    }
    public function UpdateChatStatus($id, $ecrypt)
    {
        $chat = Chat::where('encrypt', $ecrypt)->first();

        if ($chat) {
            $conversation = Conversation::find($id);

            $conversation->update(['status' => 'done']);

            $conversation->Chat->delete();
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
