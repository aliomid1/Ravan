<?php

namespace App\Http\Controllers\Advisors\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advisor\Main\Profile\ImageProfile;
use App\Http\Requests\Advisor\Main\Profile\UpdateRequest;
use App\Http\Requests\Advisor\Main\Profile\VideoProfile;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Advisors;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{

    public function SetOnline()
    {
        if (!Auth::guard('advisor')->user()->status == '1') {
            Auth::guard('advisor')->user()->update(['status' => '1']);
            return true;
        }
        return back();
    }



    public function UnsetOnline()
    {
        if (!Auth::guard('advisor')->user()->status == '0') {
            Auth::guard('advisor')->user()->update(['status' => '0']);
            return true;
        }
        return back();
    }



    public function ProfileInfoUpdate(UpdateRequest $request)
    {
        // dd('hi');
        $AdvisorId = Auth::guard('advisor')->user()->id;
        $Advisor = Advisors::find($AdvisorId);
        $networks = array();
        if ($request->telegram) {
            $networks['telegram'] = $request->telegram;
        }
        if ($request->instagram) {
            $networks['instagram'] = $request->instagram;
        }
        if ($request->whatsapp) {
            $networks['whatsapp'] = $request->whatsapp;
        }
        if ($request->facebook) {
            $networks['facebook'] = $request->facebook;
        }
        if ($request->linkdin) {
            $networks['linkdin'] = $request->linkdin;
        }
        if ($request->mailito) {
            $networks['mailito'] = $request->mailito;
        }
        $networks = serialize($networks);
        $Advisor->update(['networks' => $networks]);
        // dd(unserialize($Advisor->networks));

        $Advisor->update($request->only(['name', 'username', 'email', 'mobile', 'tel', 'address', 'networks', 'price',]));
        // dd($request->password);
        if ($request->password) {
            // dd($Advisor);
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
            $Advisor->update($request->only(['password']));
        }
        FlashMessage::set('success', 'اطلاعات با موفقيت ويرايش شد');
        return back();
    }




    public function ProfileImageUpdate(ImageProfile $request)
    {
        $Advisor =  Auth::guard('advisor')->user();
        if ($Advisor) {
            $image = Image::where([
                'item_id' => $Advisor->id,
                'type' => 'profile_advisor'
            ])->first();
            if ($image) {
                $image->update(['url' => ImageUploader::upload($request->file('image'), 'Advisors/Profile/', null, $image->url)]);
            } else {
                $image =   Image::create(['url' => ImageUploader::upload($request->file('image'), 'Advisors/Profile/'), 'type' => 'profile_advisor', 'item_id' => $Advisor->id]);
            }
            if ($image) {
                return $image->url;
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    }




    public function ProfileVideoUpdate(VideoProfile $request)
    {
        $advisor = Auth::guard('advisor')->user();
        if ($request->video != null) {
            $file = $request->video;
            $filename = $file->getClientOriginalName();
            $path = public_path() . '/uploads/Videos/';
            $file->move($path, $filename);
            $request->request->add(['videoName' => '/uploads/Videos/' . $filename]);
            $advisor->update(['video' => $request->videoName]);
        }else{
            $advisor->update(['video' => '']);
        }

        return back();
    }



    public function ProfileBioUpdate(Request $request)
    {
        $Advisor =  Auth::guard('advisor')->user();
        $Advisor->update($request->only(['bio', 'resume',]));
        $json = '';
        if ($request->education) {
            $json = json_encode($request->education, true);
        }
        $Advisor->update(['education' => $json]);
        return back();
    }

    public function BuyPlan($id)
    {
        # code...
    }

}
