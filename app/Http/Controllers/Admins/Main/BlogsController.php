<?php

namespace App\Http\Controllers\Admins\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lib\File\BaseUploader;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Blog;
use App\Models\BlogsCategory;
use App\Models\Image;

class BlogsController extends Controller
{

    public function index()
    {
        return view('Admins.Blogs.index');
    }



    public function create()
    {
        return view('Admins.Blogs.create');
    }



    public function store(Request $request)
    {
        if ($request->title) {
            $result = Blog::create($request->except(['_token', 'image', 'category']));
            if ($result) {
                if ($request->category) {
                    $category = implode(',', $request->category);
                    $result->update(['categories' => $category]);
                }
                if ($request->image) {
                    Image::create(['url' => ImageUploader::upload($request->image, 'Blogs/'), 'item_id' => $result->id, 'type' => 'blogs']);
                }
                FlashMessage::set('success', 'مقاله  جدید ثبت شد');
                return back();
            } else {
                FlashMessage::set('error', 'مشکلی پیش آمده');
                return back();
            }
        } else {
            FlashMessage::set('error', 'درخواست کامل نیست');
            return back();
        }
    }



    public function show($id)
    {
        $blog = Blog::where('id', $id)->first();
        $image = \App\Models\Image::where(['type'=>'blogs','item_id'=>$blog->id])->first();
        return view('Admins.Blogs.blog', compact(['blog', 'image']));
    }

    public function edit(Request $request , $id)
    {
        $Category = BlogsCategory::get();
        $blog =  Blog::find($id);
        $SelectedCat = explode(',' , $blog->categories);
        $image = \App\Models\Image::where(['type'=>'blogs','item_id'=>$blog->id])->first();
        return view('Admins.Blogs.edit' , compact(['blog' , 'image' , 'Category' , 'SelectedCat']));
    }



    public function update(Request $request , $id)
    {
        if ($request->title) {
            $blog = Blog::where('id', $id)->first();
            $res = $blog->update($request->except(['_token', 'image', 'category']));
            if ($res) {
                if ($request->category) {
                    $category = implode(',', $request->category);
                    $blog->update(['categories' => $category]);
                }
                if ($request->image) {
                    $image = Image::where('item_id', $id)->where('type', 'blogs')->first();
                    if ($image) {
                        $image->update(['url' => ImageUploader::upload($request->image, 'Blogs/', null, $image->url)]);
                    } else {
                        Image::create(['url' => ImageUploader::upload($request->image, 'Blogs/'), 'item_id' => $blog->id, 'type' => 'blogs']);
                    }
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



    public function destroy(Request $request , $id)
    {

        if ($request->id) {
            $blog = Blog::where('id', $request->id)->delete();
            if ($blog) {
                $image = Image::where('item_id', $request->id)->where('type', 'blogs')->first();
                // BaseUploader::delete($image->image);
                $image->delete();
                return true;
            } else {
                return 'درخواست کامل نیست';
            }
        } else {
            return 'درخواست کامل نیست';
        }
    }
}
