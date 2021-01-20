<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Comment;
use App\Models\HomePage;
use App\Models\Image;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function edit()
    {
        $Comments = Comment::paginate(19);


        $MainImage = Image::where('type', 'HomePage')->first();


        $Services = json_decode(HomePage::first()->services, true);
        if (!is_array($Services) && !is_object($Services)) {
            $Services = [];
        }


        $Guidences = json_decode(HomePage::first()->guidences, true);
        if (!is_array($Guidences) && !is_object($Guidences)) {
            $Guidences = [];
        }


        $Footer = json_decode(HomePage::first()->footer, true);
        if (!isset($Footer['trust']['items'])) {
            $Footer['trust']['items'] = [];
        }

        if (!isset($Footer['social_media'])) {
            $Footer['social_media'] = [];
        }
        // dd($Footer);

        
        return view('Admins.HomePage.edit', compact(['Services', 'Guidences', 'Comments', 'MainImage', 'Footer']));
    }



    public function update(Request $request)
    {
        // dd($request->all());
        $HomePage = HomePage::first();

        
        if ($request->services) {
            // dd($request->services);
            json_encode($request->services, true);
            $HomePage->update($request->only('services'));
        }


        if ($request->guidences) {
            json_encode($request->guidences, true);
            $HomePage->update($request->only('guidences'));
        }


        if ($request->main_image) {
            $image = Image::where('type', 'HomePage')->first();
            if ($image) {
                $image->update(['url' => ImageUploader::upload($request->main_image, 'HomePage/', null, $image->url)]);
            } else {
                Image::create(['url' => ImageUploader::upload($request->main_image, 'HomePage/'), 'item_id' => '1', 'type' => 'HomePage']);
            }
        }


        if ($request->footer) {
            $NewFooter = []; 
            $Footer = json_decode(HomePage::first()->footer, true);
            foreach ($request->footer['trust']['items'] as $key => $value) {
                if (isset($value['trust_image'])) {
                    if (isset($Footer['trust']['items'][$key]['trust_image'])) {
                        $NewFooter['trust']['items'][$key]['trust_image'] = ImageUploader::upload($value['trust_image'], 'FooterTrustImage/', null, $Footer['trust']['items'][$key]['trust_image']);
                    } else {
                        $NewFooter['trust']['items'][$key]['trust_image'] = ImageUploader::upload($value['trust_image'], 'FooterTrustImage/');
                    }
                } else{
                    if(isset($Footer['trust']['items'][$key]['trust_image'])){
                        $NewFooter['trust']['items'][$key]['trust_image'] = $Footer['trust']['items'][$key]['trust_image'];
                    }
                }

                if (isset($value['trust_link'])) {
                    $NewFooter['trust']['items'][$key]['trust_link'] = $value['trust_link'];
                }
            }
            
            if (isset($request->footer['trust']['detail'])){
                $NewFooter['trust']['detail'] = $request->footer['trust']['detail'];
            }
            

            foreach ($request->footer['social_media'] as $key => $value) {
                if (isset($value['social_media_image'])) {
                    if (isset($Footer['social_media'][$key]['social_media_image'])) {
                        $NewFooter['social_media'][$key]['social_media_image'] = ImageUploader::upload($value['social_media_image'], 'FooterSocialMediaImage/', null, $Footer['social_media'][$key]['social_media_image']);
                    } else {
                        $NewFooter['social_media'][$key]['social_media_image'] = ImageUploader::upload($value['social_media_image'], 'FooterSocialMediaImage/');
                    }
                } else{
                    if(isset($Footer['social_media'][$key]['social_media_image'])){
                        $NewFooter['social_media'][$key]['social_media_image'] = $Footer['social_media'][$key]['social_media_image'];
                    }
                }

                if (isset($value['social_media_link'])) {
                    $NewFooter['social_media'][$key]['social_media_link'] = $value['social_media_link'];
                }
            }
            
            // dd($NewFooter);
            $HomePage->update(['footer' => json_encode($NewFooter, true)]);
            // dd('hi');
            
            // if (isset($request->footer['trust'])) {
            //     if (isset($request->footer['trust']['trust_image'])) {
            //         $image = Image::where('type', 'HomePage')->first();
                    
            //     }
            //     if ($image) {
            //         $image->update(['url' => ImageUploader::upload($request->image, 'HomePage/', null, $image->url)]);
            //     } else {
            //         Image::create(['url' => ImageUploader::upload($request->image, 'HomePage/'), 'item_id' => '1', 'type' => 'HomePage']);
            //     }
            // }
        }

        FlashMessage::set('success', 'بروز رسانی انجام شد');
        return back();
    }



    public function publication(Request $request)
    {
        $id = $request->DataId;
        // dd(Comment::find($id)->publication);
        if (Comment::find($id)->publication == 'on') 
        {
            Comment::find($id)->update(['publication' => 'off']);
            return false;
        } 
        else{
            Comment::find($id)->update(['publication' => 'on']);
            return true;
        }
    }



    public function PopupIndex()
    {
        $page = HomePage::first();
        return view('Admins.Pages.Popup.edit', compact('page'));
    }



    public function PopupUpdate(Request $request)
    {
        $Home = HomePage::first();
        if ($request->popup_content) {
            if ($request->popup_sleep) {
                $Home->update([
                    'popup_content' => $request->popup_content,
                    'popup_sleep' => $request->popup_sleep,
                 ]);
            } else{
                FlashMessage::set('error', 'لطفا زمان تاخیر اجرا شدن را وارد نمایید.');
                return redirect()->back();
            }
        } else{
            $Home->update([
                'popup_content' =>null,
                'popup_sleep' => null,
            ]);
        }
        FlashMessage::set('success', 'عملیات با موفقیت انجام شد.');
        return redirect()->back();
    }
}
