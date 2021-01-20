<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\lib\File\ImageUploader;
use App\lib\Messages\FlashMessage;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create()
    {
        return view('Admins.Subject.Category.create');
    }
    public function store(Request $request)
    {
        if ($request->title) {
            $category = Category::create($request->except(['_token', 'image']));
            if ($category) {
                if ($request->image) {
                    Image::create(['url' => ImageUploader::upload($request->image, 'Category/'), 'item_id' => $category->id, 'type' => 'category']);
                }
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
        $category = Category::find($id);
        if ($category) {
            return view('Admins.Subject.Category.edit', compact('category'));
        } else {
            FlashMessage::set('error', 'درخواست کامل نبود');
            return back();
        }
    }


    public function update(Request $request)
    {
        if ($request->id) {
            $category = Category::find($request->id);
            $image = Image::where('item_id', $category->id)->where('type', 'category')->first();
            if ($category) {
                if ($request->image) {
                    if ($image) {
                        $image->update(['url' => ImageUploader::upload($request->image, 'Category/', null, $image->url)]);
                    } else {
                        Image::create(['url' => ImageUploader::upload($request->image, 'Category/'), 'item_id' => $category->id, 'type' => 'category']);
                    }
                }
                $category->update($request->except(['_token','_method','image']));
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
             $category = Category::find($request->id);
             if ($category) {

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
