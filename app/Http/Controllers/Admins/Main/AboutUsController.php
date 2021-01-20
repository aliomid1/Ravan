<?php

namespace App\Http\Controllers\Admins\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lib\File\BaseUploader;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\AboutUs;
use App\Models\Image;

class AboutUsController extends Controller
{
    public function edit()
    {
        $AboutUs = AboutUs::first();
         $Advantages = json_decode(AboutUs::first()->advantages , true);
        if (!is_array($Advantages) && !is_object($Advantages)) {
            $Advantages =[];
        }
        $Image = Image::where('type' , 'AboutUs')->first();
        return view('Admins.AboutUs.edit' , compact(['AboutUs' , 'Image', 'Advantages']));
    }



    public function update(Request $request)
    {
        
        if ($request->title) {
            $AboutUs = AboutUs::first();
            // dd($request->all());
            $res = $AboutUs->update($request->only(['title', 'description', 'target']));
            if ($res) {
                if ($request->image) {
                    $image = Image::where('type', 'AboutUs')->first();
                    if ($image) {
                        $image->update(['url' => ImageUploader::upload($request->image, 'AboutUs/', null, $image->url)]);
                    } else {
                        Image::create(['url' => ImageUploader::upload($request->image, 'Aboutus/'), 'item_id' => '1', 'type' => 'AboutUs']);
                    }
                }
                if ($request->advantages) {
                    $Advantages = json_encode($request->advantages , true);
                    $AboutUs->update($request->only(['advantages']));
                }
                FlashMessage::set('success', 'بروز رسانی انجام شد');
                return back();
            } else {
                FlashMessage::set('error', 'مشکلی پیش امده');
                return back();
            }
        } else {
            FlashMessage::set('error', 'درخواست کامل نیست');
            return back();
        }
    }
}
