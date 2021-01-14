<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\BlogsComment;
use Illuminate\Http\Request;

class BlogsCommentsController extends Controller
{
    public function publication(Request $request)
    {
        $id = $request->DataId;
        // dd(Comment::find($id)->publication);
        if (BlogsComment::find($id)->publication == 'on') {
            BlogsComment::find($id)->update(['publication' => 'off']);
            return false;
        } elseif (BlogsComment::find($id)->publication == 'off' || BlogsComment::find($id)->publication == null) {
            BlogsComment::find($id)->update(['publication' => 'on']);
            return true;
        }
    }



    public function destroy(Request $request)
    {

        if ($request->id) {
            $BlogsComment = BlogsComment::find($request->id);
            if ($BlogsComment) {
                $BlogsComment->delete();
                return true;
            } else {
                FlashMessage::set('error', 'درخواست کامل نبود');
                return back();
            }
        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }
}
