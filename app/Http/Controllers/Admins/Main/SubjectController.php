<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Image;
use App\Models\Subject;
use App\Models\SubjectComments;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function create()
    {
        return view('Admins.Subject.create');
    }


    public function store(Request $request)
    {
        if ($request->title) {
            $subject = Subject::create($request->except(['_token', 'image' , 'category_id', 'tags']));
            if ($request->image) {
                Image::create(['url' => ImageUploader::upload($request->image, 'Subjects/'), 'item_id' => $subject->id, 'type' => 'subject']);
            } 
            if ($request->category_id) {
                $category = implode(',', $request->category_id);
                $subject->update(['categories' => $category]);
            }
            if ($request->tags) {
                $tags = json_encode($request->tags);
                $subject->update(['tags' => $tags]);
            }
            FlashMessage::set('success', 'موضوع ثبت شد');
            return back();
        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }


    public function edit($id)
    {
        if ($id) {
            $subject = Subject::find($id);
            $SelectedCat = explode(',' , $subject->categories); 
            $image = \App\Models\Image::where(['type'=>'subject','item_id'=>$id])->first();
            $Comments = SubjectComments::where('subject_id' , $id)->paginate(15);
            // dd($Comments);
            $tags = json_decode($subject->tags);
            if (!is_array($tags) && !is_object($tags)) {
                $tags = [];
            }
            if ($subject) {
                return view('Admins.Subject.edit', compact('subject' , 'SelectedCat' , 'image' , 'tags' , 'Comments'));
            } else {
                FlashMessage::set('error', 'درخواست کامل نبود');
                return back();
            }

        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        if ($request->id) {
            $subject = Subject::find($request->id);
            $image = Image::where('item_id', $subject->id)->where('type', 'subject')->first();
            if ($subject) {
                if ($request->image) {
                    if ($image) {
                        $image->update(['url' => ImageUploader::upload($request->image, 'Subjects/', null, $image->url)]);
                    } else {
                        Image::create(['url' => ImageUploader::upload($request->image, 'Subjects/'), 'item_id' => $subject->id, 'type' => 'subject']);
                    }
                }
                
                if ($request->category_id) {
                    $category = implode(',', $request->category_id);
                    $subject->update(['categories' => $category]);
                }
                if ($request->tags) {
                    $tags = (json_encode($request->tags , true));
                    $subject->update(['tags' => $tags]);
                } else{
                    $subject->update(['tags' => null]);
                }

                $subject->update($request->except(['_token','_method','image' , 'category_id']));
                FlashMessage::set('success', 'موضوع ویرایش شد');
                return back();
            } else {
                FlashMessage::set('error', 'درخواست کامل نبود');
                return back();
            }
        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        if ($request->id) {
            $subject = Subject::find($request->id);
            if ($subject) {
                $subject->delete();
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
