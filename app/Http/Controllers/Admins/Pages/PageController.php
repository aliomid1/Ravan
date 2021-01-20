<?php

namespace App\Http\Controllers\Admins\Pages;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->title) {
            Page::create($request->only(['title', 'titlemenu', 'keywords', 'description', 'content', 'statusmenu']));
            FlashMessage::set('success', 'صفحه ایجاد شد');
            return back();
        } else {
            FlashMessage::set('error', 'درخواست کامل نیست');
            return back();
        }
    }
    public function edit(Request $request)
    {
        $page = Page::find($request->id);
        return view('Admins.Pages.edit', ['page' => $page]);
    }
    public function update(Request $request)
    {
        if ($request->id) {
            $page  = Page::find($request->id);
            if ($page) {
                $page->update($request->except(['_token']));
                FlashMessage::set('success', 'صفحه ویرایش شد');
                return back();
            }
        }
        FlashMessage::set('error', 'درخواست کامل نیست');
        return back();
    }
    public function destroy(Request $request)
    {
        if ($request->id) {
            $page = Page::find($request->id);
            if ($page) {
                $page->delete();
                File::deleteDirectory(public_path('path/to/folder'));
                FlashMessage::set('success', 'صفحه حذف شد');
                return back();
            }
        }
        FlashMessage::set('error', 'درخواست کامل نیست');
        return back();
    }
}
