<?php

namespace App\Http\Controllers\Admins\Plans;

use App\Http\Controllers\Controller;
use App\lib\Messages\FlashMessage;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{


    public function store(Request $request)
    {
        if ($request->title) {
            Plan::create($request->only(['title', 'price', 'description', 'time']));
            FlashMessage::set('success', 'پلن جدید افزوده شد');
            return back();
        } else {
            FlashMessage::set('error', 'درخواست کامل نیست');
            return back();
        }
    }

    public function edit($id)
    {
        $plan = Plan::find($id);
        if ($plan) {
            return response([
                'id' => $plan->id,
                'title' => $plan->title,
                'price' => $plan->price,
                'description' => $plan->description,
                'time' => $plan->time
            ]);
        } else {
            return false;
        }
    }

    public function update(Request $request)
    {
        if ($request->id) {
            $plan = Plan::find($request->id);
            if ($plan) {
                $plan->update($request->only(['title', 'price', 'description', 'time']));
                FlashMessage::set('success', 'پلن ویرایش شد');
                return back();
            }
        }
        FlashMessage::set('error', 'درخواست کامل نیست');
        return back();
    }

    public function destroy($id)
    {
        if ($id) {
            $plan = Plan::find($id);
            if ($plan) {
                $plan->delete();
                return true;
            }
        }
        return false;
    }
}
