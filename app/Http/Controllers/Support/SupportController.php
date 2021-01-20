<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Support;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{



    public function store(Request $request)
    {
        if ($request->title) {
            Support::create([
                'user_id' => Auth::guard($request->type_user)->user()->id,
                'title' => $request->title,
                'type_user' => $request->type_user,
                'status' => 'new'

            ]);
            return back();
        } else {
            FlashMessage::set('error', 'عنوان تیکت را وارد کنید');
            return back();
        }
    }
    public function sendmessage(Request $request)
    {
        SupportMessage::create([
            'support_id' => $request->id,
            'message' => $request->text,
            'user_id' => Auth::guard($request->type_user)->user()->id
        ]);
        $support=Support::find($request->id);
        $support->update(['status'=>'new']);
        $messages  = SupportMessage::where(['support_id' => $support->id])->get();
        return view('components.support.Messages', ['messages' => $messages, 'support' => $support])->render();
    }

    public function show($id, Request $request)
    {
        $support = Support::where(['id' => $request->id, 'user_id' => Auth::guard($request->type_user)->user()->id])->first();
        $support->update(['status'=>'on']);
        if ($support) {
            $messages  = SupportMessage::where(['support_id' => $support->id])->get();
            return view('components.support.Messages', ['messages' => $messages, 'support' => $support])->render();
        }
    }



}
