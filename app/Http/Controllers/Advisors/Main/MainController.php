<?php

namespace App\Http\Controllers\Advisors\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advisor\Main\SetAdvisesTime\DateAndTimesRequest;
use App\lib\Messages\FlashMessage;
use App\Models\Conversation;
use App\Models\Image;
use App\Models\Plan;
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
        $Conversation = Conversation::where('status', 'done');
        $Transections = Transaction::where('advisor_id', $Advisor->id)->get();

        $days2 = [];
        for ($i = 1; $i <= 10; $i++) {
            $days2 += [$i => Carbon::now()->subdays($i)];
        }
        $Income = '';
        foreach ($days2 as $key => $value) {
            if ($key == 1) {
                $Income .= $Transections->where('created_at', '<', Carbon::now())->where('created_at', '>', $value)->sum('price') . ',';
            } else {
                $Income .= $Transections->where('created_at', '<', $value)->where('created_at', '>', $days2[$key - 1])->sum('price') . ',';
            }
        }

        $days30 = [];
        for ($i = 1; $i <= 30; $i++) {
            $days30 += [$i => Carbon::now()->subdays($i)];
        }
        $Income30days = '';
        $Income30 = 0;
        foreach ($days30 as $key2 => $value2) {
            if ($key2 == 1) {
                $Income30days .= $Transections->where('created_at', '<', Carbon::now())->where('created_at', '>', $value2)->sum('price') . ',';
                $Income30 += $Transections->where('created_at', '<', Carbon::now())->where('created_at', '>', $value2)->sum('price');
            } else {
                $Income30days .= $Transections->where('created_at', '<', $value)->where('created_at', '>', $days30[$key2 - 1])->sum('price') . ',';
                $Income30 += $Transections->where('created_at', '<', $value)->where('created_at', '>', $days30[$key2 - 1])->sum('price');
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
        $ConsultationsTimes = json_decode($Advisor->consultations_times, true);
        if (!isset($ConsultationsTimes['Sliced'])) {
            $ConsultationsTimes['Sliced'] = [];
        }
        $ConsultationsTimes = $ConsultationsTimes['Sliced'];
        ksort($ConsultationsTimes);
        return view('Advisors.Main.SetAdvisesTime', compact(['ConsultationsTimes', 'TimeOfOneCosultation']));
    }

    public function SetAdvisesTime_create(DateAndTimesRequest $request)
    {
        $Advisor = Auth::guard('advisor')->user();
        $OldConsultationsTimes = json_decode($Advisor->consultations_times, true);



        if ($request->Date) {
            if ($request->EndTime && $request->StartTime && $request->EndTime > $request->StartTime) {

                if (isset($OldConsultationsTimes['NotSliced'][$request->Date])) {
                    foreach ($OldConsultationsTimes['NotSliced'][$request->Date] as $key => $value) {
                        if ((($value['EndTime'] >= $request->StartTime) && ($value['StartTime'] <= $request->StartTime)) ||
                            (($value['EndTime'] >= $request->EndTime) && ($value['StartTime'] <= $request->EndTime)) ||
                            (($value['StartTime'] > $request->StartTime) && ($value['EndTime'] < $request->EndTime))
                        ) {
                            FlashMessage::set('warning', 'لطفا مطمئن شوید که این بازه زمانی از تاریخ، پیش از این انتخاب نشده است.');
                            return back();
                        }
                    }
                    $LastKey = array_key_last($OldConsultationsTimes['NotSliced'][$request->Date]);
                    $LastKey++;
                    $OldConsultationsTimes['NotSliced'][$request->Date][$LastKey] = [
                        'StartTime' => $request->StartTime,
                        'EndTime' => $request->EndTime,
                    ];
                } else {
                    $OldConsultationsTimes['NotSliced'][$request->Date][0] = [
                        'StartTime' => $request->StartTime,
                        'EndTime' => $request->EndTime,
                    ];
                }

                $TimeOfOneCosultation = Settings::first()->time_default;
                if (!($Advisor->time_of_one_consultation)) {
                    $TimeOfOneCosultatio = Auth::guard('advisor')->user()->time_of_one_consultation;
                }
                if (!is_array($OldConsultationsTimes['NotSliced']) && !is_Object($OldConsultationsTimes['NotSliced'])) {
                    $OldConsultationsTimes['NotSliced'] = [];
                }
                foreach ($OldConsultationsTimes['NotSliced'] as $NumberOfDate => $DateItems) {
                    if (isset($DateItems)) {
                        $Kyes = 0;
                        foreach ($DateItems as $Key => $Values) {
                            if (isset($Values['StartTime']) && isset($Values['EndTime'])) {
                                $TimeStep = $Values['StartTime'];
                                $OldConsultationsTimes['Sliced'][$NumberOfDate][$Kyes]['Time'] = $TimeStep;
                                $OldConsultationsTimes['Sliced'][$NumberOfDate][$Kyes]['Status'] = '1';
                                $Kyes++;
                                $TimeStep = Carbon::parse($TimeStep)->addMinutes(3)->format('H:i');
                                while ($TimeStep <= Carbon::parse($Values['EndTime'])->subMinutes($TimeOfOneCosultation)->format('H:i')) {
                                    $TimeStep = Carbon::parse($TimeStep)->addMinutes($TimeOfOneCosultation)->format('H:i');
                                    $OldConsultationsTimes['Sliced'][$NumberOfDate][$Kyes]['Time'] = $TimeStep;
                                    $OldConsultationsTimes['Sliced'][$NumberOfDate][$Kyes]['Status'] = '1';
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
        $Date = $request->Date;
        $OldConsultationsTimes = json_decode($Advisor->consultations_times, true);

        $Reserved = array_filter($OldConsultationsTimes['Sliced'][$request->Date], function ($item) {
            return $item['Status'] == '0';
        });
        // dd($OldConsultationsTimes);
        if (isset($OldConsultationsTimes['Sliced'][$request->Date]) && empty($Reserved)) {
            unset($OldConsultationsTimes['NotSliced'][$request->Date]);
            unset($OldConsultationsTimes['Sliced'][$request->Date]);
            FlashMessage::set('success', 'حذف با موفقیت انجام شد.');
            return back();
        } else {
            FlashMessage::set('warning', 'لطفا پیش از حذف کردن مطمئن شوید تایمی در این تاریخ رزرو نشده است.');
            return back();
        }
        $Advisor->update(['consultations_times' => json_encode($OldConsultationsTimes, true)]);
        return back();
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
