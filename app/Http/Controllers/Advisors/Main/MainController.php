<?php

namespace App\Http\Controllers\Advisors\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advisor\Main\SetAdvisesTime\DateAndTimesRequest;
use App\lib\Messages\FlashMessage;
use App\Models\Advisors;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\Image;
use App\User;
use App\Models\PlansAdvisor;
use App\Models\Settings;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function Login()
    {
        return view('Advisors.Main.dashboard');
    }



    public function Dashboard()
    {
        $Setting = Settings::first();
        $Advisor = Auth::guard('advisor')->User();
        $Advisor_id = Auth::guard('advisor')->User()->id;
        $Conversation = Conversation::where('advisor_id', $Advisor_id )->where('status', 'done');
        $Transections = Transaction::where('advisor_id', $Advisor->id)->where('type', '!=', 'plan')->get();

        $days2 = [];
        for ($i = 1; $i <= 10; $i++) {
            $days2 += [$i => Carbon::now()->subdays($i)];
        }
        $Income = '';
        foreach ($days2 as $key => $value) {
            $Transections2 = $Transections;
            if ($key == 1) {
                $Income .= $Transections2->where('created_at', '<', Carbon::now())->where('created_at', '>', $value)->sum('price') . ',';
            } else {
                $Income .= $Transections2->where('created_at', '<', $value)->where('created_at', '>', $days2[$key == 10 ? 10 : $key + 1])->sum('price') . ',';
            }
        }

        $days30 = [];
        for ($i = 1; $i <= 30; $i++) {
            $days30 += [$i => Carbon::now()->subdays($i)];
        }
        $Income30days = '';
        $Income30 = 0;
        foreach ($days30 as $key2 => $value2) {
            $Transections2 = $Transections;
            if ($key2 == 1) {
                $Income30days .= $Transections2->where('created_at', '<', Carbon::now())->where('created_at', '>', $value2)->sum('price') . ',';
                $Income30 += $Transections2->where('created_at', '<', Carbon::now())->where('created_at', '>', $value2)->sum('price');
            } else {

                $Income30days .= $Transections2->where('created_at', '<', $value2)->where('created_at', '>', $days30[$key2 == 30 ? 30 : $key2 + 1])->sum('price') . ',';
                $Income30 += $Transections2->where('created_at', '<', $value2)->where('created_at', '>', $days30[$key2 == 30 ? 30 : $key2 + 1])->sum('price');
            }
        }

        $Timem2 = PlansAdvisor::where('user_id', $Advisor->id)->first();
        if ($Timem2) {
            $now = Carbon::now();
            $Timem = Carbon::parse($Timem2->time);
            if ($now >= $Timem) {
                $Advisor->update(['vip' => '0']);
                $Timem2->delete();
                $Timem = 0;
            } else {
                $Timem = $Timem->diffInDays($now);
            }
        } else {
            $Timem = 0;
        }
        $Timeplan = PlansAdvisor::where('user_id', $Advisor->id)->first();
        if ($Timeplan) {
            $Timeplan = $Timeplan->Plan->time;
        } else {
            $Timeplan = 0;
        }
        $Advisor_Image = Image::where('item_id', $Advisor_id)->where('type', 'profile_advisor')->first();
        return view(
            'Advisors.Main.Dashboard',
            [
                'Setting' => $Setting,
                'Advisor' => $Advisor,
                'Advisor_id' => $Advisor_id,
                'Conversation' => $Conversation,
                'Transections' => $Transections,
                'Income' => $Income,
                'Income30days' => $Income30days,
                'Income30' => $Income30,
                'Timem' => $Timem,
                'Timeplan' => $Timeplan,
                'Advisor_Image' => $Advisor_Image
            ]
        );
    }



    public function Profile()
    {
        return view('Advisors.Main.Profile');
    }



    public function SetAdvisesTime()
    {
        $Advisor = Auth::guard('advisor')->user();
        $TimeOfOneCosultation = Settings::first()->time_default;
        if (!($Advisor->time_of_one_consultation)) {
            $TimeOfOneCosultatio = Auth::guard('advisor')->user()->time_of_one_consultation;
        }
        $Consultations = json_decode($Advisor->consultations_times, true);
        $Consultations = $this->ExpirationTime($Consultations);
        $ConsultationsTimes = [];
        if ($Consultations) {
            foreach ($Consultations as $key => $v) {
                if (!isset($v['Sliced'])) {
                    $v['Sliced'] = [];
                }
                $ConsultationsTimes[$key] = $v['Sliced'];
                ksort($v);
            }
        }

        $ConsultationsTimes = view('components.Advisor.ListTimes', ['ConsultationsTimes' => $ConsultationsTimes, 'TimeOfOneCosultation' => $TimeOfOneCosultation])->render();
        return view('Advisors.Main.SetAdvisesTime', compact(['ConsultationsTimes', 'TimeOfOneCosultation']));
    }

    public function SetAdvisesTime_create(DateAndTimesRequest $request)
    {

        $Advisor = Auth::guard('advisor')->user();
        $OldConsultationsTimes = json_decode($Advisor->consultations_times, true);
        if ($request->Date) {
            if ($request->EndTime && $request->StartTime && $request->EndTime > $request->StartTime) {
                $ck = $this->CkeckTimeSet($OldConsultationsTimes, $request);
                if (!$ck) {
                    FlashMessage::set('warning', 'لطفا مطمئن شوید که این بازه زمانی از تاریخ، پیش از این انتخاب نشده است.');
                    return back();
                }
                if (isset($OldConsultationsTimes[$request->type]['NotSliced'][$request->Date])) {
                    $LastKey = array_key_last($OldConsultationsTimes[$request->type]['NotSliced'][$request->Date]);
                    $LastKey++;
                    $OldConsultationsTimes[$request->type]['NotSliced'][$request->Date][$LastKey] = [
                        'StartTime' => $request->StartTime,
                        'EndTime' => $request->EndTime,
                    ];
                } else {
                    $OldConsultationsTimes[$request->type]['NotSliced'][$request->Date][0] = [
                        'StartTime' => $request->StartTime,
                        'EndTime' => $request->EndTime,
                    ];
                }

                $TimeOfOneCosultation = Settings::first()->time_default;
                if (!($Advisor->time_of_one_consultation)) {
                    $TimeOfOneCosultatio = Auth::guard('advisor')->user()->time_of_one_consultation;
                }
                if (!is_array($OldConsultationsTimes[$request->type]['NotSliced']) && !is_Object($OldConsultationsTimes[$request->type]['NotSliced'])) {
                    $OldConsultationsTimes[$request->type]['NotSliced'] = [];
                }
                foreach ($OldConsultationsTimes[$request->type]['NotSliced'] as $NumberOfDate => $DateItems) {
                    if (isset($DateItems)) {
                        $Kyes = 0;
                        foreach ($DateItems as $Key => $Values) {
                            if (isset($Values['StartTime']) && isset($Values['EndTime'])) {
                                $TimeStep = $Values['StartTime'];
                                $OldConsultationsTimes[$request->type]['Sliced'][$NumberOfDate][$Kyes]['Time'] = $TimeStep;
                                $OldConsultationsTimes[$request->type]['Sliced'][$NumberOfDate][$Kyes]['Status'] = '1';
                                $Kyes++;
                                $TimeStep = Carbon::parse($TimeStep)->addMinutes(3)->format('H:i');
                                while ($TimeStep <= Carbon::parse($Values['EndTime'])->subMinutes($TimeOfOneCosultation)->format('H:i')) {
                                    $TimeStep = Carbon::parse($TimeStep)->addMinutes($TimeOfOneCosultation)->format('H:i');
                                    $OldConsultationsTimes[$request->type]['Sliced'][$NumberOfDate][$Kyes]['Time'] = $TimeStep;
                                    $OldConsultationsTimes[$request->type]['Sliced'][$NumberOfDate][$Kyes]['Status'] = '1';
                                    $Kyes++;
                                    $TimeStep = Carbon::parse($TimeStep)->addMinutes(3)->format('H:i');
                                }
                            }
                        }
                    }
                }

                $Advisor->update(['consultations_times' => json_encode($OldConsultationsTimes, true)]);

                FlashMessage::set('success', 'زمان وارد شده با موفقیت ثبت شد.');
                return back();
            } else {
                FlashMessage::set('warning', 'در ساعات وارد شده مشکلی وجود دارد.');
                return back();
            }
        } else {
            FlashMessage::set('warning', 'در تاریخ وارد شده مشکلی وجود دارد.');
            return back();
        }
    }

    public function SetAdvisesTime_delete(Request $request)
    {

        $Advisor = Auth::guard('advisor')->user();
        $OldConsultationsTimes = json_decode($Advisor->consultations_times, true);
        $Reserved = array_filter($OldConsultationsTimes[$request->Key]['Sliced'][$request->Date], function ($item) {
            return $item['Status'] == '0';
        });

        if (isset($OldConsultationsTimes[$request->Key]['Sliced'][$request->Date]) && empty($Reserved)) {
            unset($OldConsultationsTimes[$request->Key]['NotSliced'][$request->Date]);
            unset($OldConsultationsTimes[$request->Key]['Sliced'][$request->Date]);
            $Advisor->update(['consultations_times' => json_encode($OldConsultationsTimes, true)]);
            FlashMessage::set('success', 'حذف با موفقیت انجام شد.');
            return back();
        } else {
            FlashMessage::set('warning', 'لطفا پیش از حذف کردن مطمئن شوید تایمی در این تاریخ رزرو نشده است.');
            return back();
        }
    }



    public function Conversations()
    {
        return view('Advisors.Main.Conversations');
    }

    public function Chats()
    {
        return view('Advisors.Main.Chats');
    }



    public function NowAdviced()
    {
        return view('Advisors.Main.NowAdviced');
    }



    public function FuturistAdvice()
    {
        return view('Advisors.Main.FuturistAdvice');
    }

    public function EndReserve(Request $request)
    {
        $Advisor = Auth::guard('advisor')->user();
        $Conversation = Conversation::where([
            'advisor_id' => $Advisor->id,
            'id' => $request->id,
            'code' => $request->code
        ])->first();
        if ($Conversation) {
            $Conversation->update(['status' => 'done']);
            FlashMessage::set('success', 'درخواست ثبت شد');
            return back();
        } else {
            FlashMessage::set('warning', 'درخواست کامل نیست');
            return back();
        }
    }
    public function StartReserve(Request $request)
    {
        $Conversation = Conversation::find($request->id);

        if ($Conversation) {
            if ($Conversation->start_at <= Carbon::now()) {
                switch ($Conversation->type) {
                    case "online":
                        $chat = Chat::where('conversation_id', $Conversation->id)->first();
                        if ($chat) {
                            $Conversation->update(['status' => 'doing']);
                            $chat->update([ 'status' => true, 'used' => true]);
                            return redirect(route('Web.STARTChat', $chat->id));
                        } else {
                            $user = User::find($Conversation->user_id);
                            $advisor = Advisors::find($Conversation->advisor_id);
                            $data = [
                                'user' => $user,
                                'advisor' => $advisor,
                                'conversation' => $Conversation
                            ];
                            $chat = $this->NewChat($data);
                            $chat->update([ 'status' => true, 'used' => true]);
                            $Conversation->update(['status' => 'doing']);
                            return redirect(route('Web.STARTChat', $chat->id));
                        }

                        break;
                    case "in":
                        $Conversation->update(['status' => 'doing']);
                        FlashMessage::set('success', 'مشاوره شروع شد');
                        return back();
                        break;
                    case "out":
                        $Conversation->update(['status' => 'doing']);
                        FlashMessage::set('success', 'مشاوره شروع شد');
                        return back();
                        break;
                }
            } else {
                FlashMessage::set('error', 'مشاوره هنوز شروع نشده');
                return back();
            }
        } else {
            FlashMessage::set('error', 'مشکلی پیش امده');
            return back();
        }
    }
    public function Transactions()
    {
        return view('Advisors.Main.Transactions');
    }



    public function Support()
    {
        return view('Advisors.Main.Support');
    }


    public function BuyPlan()
    {
        return view('Advisors.Main.BuyPlan');
    }
}
