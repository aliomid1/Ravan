<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Image;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function AddHow(Request $request)
    {
        if ($request->title) {
            $res = Question::create(['title' => $request->title,
                                    'description' => $request->description,
                                    'type' => 'how',
                                    ]);
            if ($res) {
                FlashMessage::set('success', 'سوال جدید ثبت شد');
                return back();
            } else {
                FlashMessage::set('danger', 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set('danger', 'درخواست ناقص');
            return back();
        }
    }

    public function destroyHow(Request $request)
    {
        if ($request->id) {
            $res = Question::where('id', $request->id)->delete();
            if ($res) {
                FlashMessage::set('success', 'حذف انجام شد');
                return back();
            } else {
                FlashMessage::set('danger', 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set('danger', 'درخواست ناقص');
            return back();
        }
    }


    public function AddWhy(Request $request)
    {
        if ($request->title) {
            $res = Question::create(['title' => $request->title,
                                    'description' => $request->description,
                                    'type' => 'why',
            ]);
            if ($res) {
                FlashMessage::set('success', 'سوال جدید ثبت شد');
                return back();
            }
             else {
                FlashMessage::set('danger', 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set('danger', 'درخواست ناقص');
            return back();
        }
    }

    public function destroyWhy(Request $request)
    {
        if ($request->id) {
            $res = Question::where('id', $request->id)->delete();
            if ($res) {
                FlashMessage::set('success', 'حذف انجام شد');
                return back();
            } else {
                FlashMessage::set('danger', 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set('danger', 'درخواست ناقص');
            return back();
        }
    }


    public function AddImageWhy(Request $request)
    {
        if (isset($request->questions['certif_image'])) {
            foreach ($request->questions['certif_image'] as $key => $image) {
                if ($image) {
                    $res = Image::create(['url' => ImageUploader::upload($image, 'CertificationImage'), 'item_id' => $key, 'type' => 'certification_image']);
                }
            }
            if ($res) {
                FlashMessage::set('success', 'سوال جدید ثبت شد');
                return back();
            } else {
                FlashMessage::set('danger', 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set('danger', 'درخواست ناقص');
            return back();
        }
    }

    public function destroyImageWhy(Request $request)
    {
        if ($request->id) {
            ImageUploader::delete(Image::where('id', $request->id)->first()->url);
            $res = Image::where('id', $request->id)->delete();
            if ($res) {
                FlashMessage::set('success', 'حذف انجام شد');
                return back();
            } else {
                FlashMessage::set('danger', 'درخواست نامعتبر');
                return back();
            }
        } else {
            FlashMessage::set('danger', 'درخواست ناقص');
            return back();
        }
    }
}
