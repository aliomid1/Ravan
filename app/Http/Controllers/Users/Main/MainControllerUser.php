<?php

namespace app\Http\Controllers\Users\Main;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Comment;
use App\Models\Conversation;
use App\Models\Settings;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Melipayamak\MelipayamakApi;

class MainControllerUser extends Controller
{


    public function Dashboard()
    {
        $CurrentUser = Auth::user();
        $NotCommented = Conversation::where('user_id' , $CurrentUser->id)->where('status', 'done')->where('comment_status' , null)->first();
        return view('Users.Main.Dashboard', compact('NotCommented'));
    }


    public function NoCommentedConversation($ConversationId)
    {
        Conversation::find($ConversationId)->update(['comment_status' => 'off']);
        return redirect(route('Users.Dashboard'));
    }


    public function AddCommentedConversation(Request $request)
    {
        $ConversationId = $request->NotCommentedId;
        $Conversation = Conversation::find($ConversationId)->update(['comment_status' => 'on']);
        $rating = $request->rating;
        $text = $request->text;

        Comment::create([
            'user_id' => Conversation::find($ConversationId)->User,
            'advisor_id' => Conversation::find($ConversationId)->Advisor,
            'score' => $rating,
            'text' => $text,
            'status' => 'off',
            'publication' => 'off',
        ]);
        return redirect(route('Users.Dashboard'));
    }



    public function Profile()
    {
        return view('Users.Main.Profile');
    }



    public function NowAdviced()
    {
        return view('Users.Main.NowAdviced');
    }



    public function FuturistAdvice()
    {
        return view('Users.Main.FuturistAdvice');
    }



    public function Conversations()
    {
        return view('Users.Main.Conversations');
    }



    public function Share(Request $request)
    {
        $CallerId = Auth::guard('web')->user()->id;
        $UserMobileNumber = $request->mobile;
        $FinalURL = url('Login?CallerId=' . $CallerId);
        $settings = Settings::first();
        try {
            $username = env('MELIPAYAMAKUSERNAME');
            $password = env('MELIPAYAMAKPASSWORD');
            $api = new MelipayamakApi($username, $password);
            $sms = $api->sms();
            $to = $UserMobileNumber;
            $from = env('NUMBERSMS');
            $text = $settings->textmessage . '\n' . $FinalURL;
            $response = $sms->send($to, $from, $text);
            $json = json_decode($response,true);

            if ($json->Value > 12 || $json->Value == 1) {
                FlashMessage::set('success', 'پیام برای دوست شما ارسال شد');
                return back();
            } else {
                FlashMessage::set('error', 'پیام برای دوست شما ارسال نشد');
                return back();
            }
        } catch (Exception $e) {

            FlashMessage::set('error', $e->getMessage());
            return back();
        }
    }



    public function Transactions()
    {
        return view('Users.Main.Transactions');
    }



    public function Support()
    {
        return view('Users.Main.Support');
    }



    public function Assist()
    {
        return view('Users.Main.Assist');
    }


    public function Info()
    {
        return view('Web.About');
    }



    public function ListAdvisors()
    {
        return view('Users.Main.ListAdvisors');
    }



    public function Chat()
    {
        $User = Auth::guard('web')->user();
        $Conversation = Conversation::where('user_id',$User->id)->paginate(10);
       
        return view('Users.Main.Conversations',['Conversation'=>$Conversation]);
    }



    public function List()
    {
        return view('Users.Main.List');
    }
}
