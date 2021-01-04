<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\BlogsCategory;
use App\Models\Image;
use Illuminate\Http\Request;

class BlogsCategoryController extends Controller
{

    public function create()
    {
        return view('Admins.Blogs.Category.create');
    }
    public function store(Request $request)
    {
        if ($request->title) {
            $category = BlogsCategory::create($request->except(['_token', 'image']));
            if ($category) {
                FlashMessage::set('success', 'دسته ثبت شد');
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


    public function edit($id)
    {
        $category = BlogsCategory::find($id);
        if ($category) {
            return view('Admins.Blogs.Category.edit', compact('category'));
        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }


    public function update(Request $request)
    {
        if ($request->id) {
            $category = BlogsCategory::find($request->id);
            if ($category) {
                $category->update($request->except(['_token', '_method']));
                FlashMessage::set('success', 'دسته ویرایش شد');
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
        if ($request->id) {
            $category = BlogsCategory::find($request->id);
            if ($category) {
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
