<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\SubjectComments;
use Illuminate\Http\Request;

class SubjectCommentsController extends Controller
{
    public function publication(Request $request)
    {
        $id = $request->DataId;
        // dd(Comment::find($id)->publication);
        if (SubjectComments::find($id)->publication == 'on') 
        {
            SubjectComments::find($id)->update(['publication' => 'off']);
            return false;
        } 
        elseif(SubjectComments::find($id)->publication == 'off' || SubjectComments::find($id)->publication == null){
            SubjectComments::find($id)->update(['publication' => 'on']);
            return true;
        }
    }



    public function destroy(Request $request)
    {

        if ($request->id) {
            $SubjectComments = SubjectComments::find($request->id);
            if ($SubjectComments) {
                $SubjectComments->delete();
                return true;
            }else{
                FlashMessage::set('error', 'درخواست کامل نبود');
                return back();
            }
            
        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }
}
