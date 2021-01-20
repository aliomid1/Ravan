<?php

namespace App\Http\Controllers\Admins\Users;

use App\Http\Controllers\Controller;
use App\lib\File\BaseUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Image;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function update(Request $request)
    {
    }

    public function destroy(Request $request)
    {
        if ($request->id) {
            $user = User::find($request->id);
            if ($user) {
                $image = Image::where('item_id', $user->id)->where('type','profile_user')->first();
                if ($image) {
                    BaseUploader::delete($image->url);
                    $image->delete();
                }
                $user->delete();
                return true;
            } else {
                return 'درخواست کامل نبود';
            }
        } else {
            return 'درخواست کامل نبود';
        }
    }
}
