<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Settings;
use Exception;
use Illuminate\Encryption\Encrypter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Melipayamak\MelipayamakApi;
use Morilog\Jalali\Jalalian;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function Logout(Request $request)
    {
        $request->session()->flush();

        return redirect(route('Web.index'));
    }
    public function SMS($mobile, $message)
    {

        try {
            $username = env('MELIPAYAMAKUSERNAME');
            $password = env('MELIPAYAMAKPASSWORD');
            $api = new MelipayamakApi($username, $password);
            $sms = $api->sms();
            $to = $mobile;
            $from = env('NUMBERSMS');
            $text = $message;
            $response = $sms->send($to, $from, $text);
            $json = json_decode($response);
            if ($json->Value > 12 || $json->Value == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    public function CKEDITOR(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = rand(100000, 999999) . '_' . time() . '.' . $extension;
            $request->file('upload')->move('uploads/ckeditor/', $fileName);
            $url = asset('/uploads/ckeditor') . '/' . $fileName;
            $response = [
                'uploaded' => 1,
                'filename' => $fileName,
                'url' => $url,
                'error' => ''
            ];
            @header('Content-type: text/html; charset=utf-8');
            return $response;
        }
    }
    public function put_permanent_env($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }

    public function ExpirationTime($ConsultationsTimes)
    {
        $NewConsultationsTimes = [];
        $now = Jalalian::now();
        if ($ConsultationsTimes) {
            foreach ($ConsultationsTimes as $key => $v) {
                foreach ($v['Sliced'] as $d => $t) {
                    if ($now->format('Y/m/d') > $d) {
                        unset($ConsultationsTimes[$key]['Sliced'], $d);
                        unset($ConsultationsTimes[$key]['NotSliced'], $d);
                    } else {
                        foreach ($t as $i => $s) {
                            if ($s['Time'] < $now->format('H:i')) {
                                $ConsultationsTimes[$key]['Sliced'][$d][$i]['Status'] = "0";
                            }
                        }
                    }
                }
            }
        }
        $NewConsultationsTimes = $ConsultationsTimes;

        return $NewConsultationsTimes;
    }

    public function NewChat($data)
    {
        $user = $data['user'];
        $advisor = $data['advisor'];
        $conversation = $data['conversation'];
        $encrypteddata = (new Encrypter(env('APP_CIPHER_SERVERKEY')))->encryptString(json_encode([
            'user_id' => $user->id,
            'expert_id' => $advisor->id,
            'starter' => 'user'
        ]));
        $settings = Settings::find(1);
        $profileAdvisor = $advisor->Profile ? $advisor->Profile->url : '';
        $profileUser = $user->Image ? $user->Image->url : '';
        $time = $advisor->time_of_one_consultation ? $advisor->time_of_one_consultation : $settings->time_default;
        $price = $advisor->price ? $advisor->price : $settings->price_default;
        $price = ($time * $price);
        $price = $price + (($price * $settings->percent) / 100);
        $time = (60 * $time);
        $chat = Chat::create([
            'status' => false,
            'used' => false,
            'user_id' => $user->id,
            'conversation_id' => $conversation->id,
            'expiretime' => $time,
            'expert_id' => $advisor->id,
            'user_name' => $user->fullname,
            'expert_name' =>  $advisor->name,
            'user_profile' => $profileUser,
            'advisor_profile' => $profileAdvisor,
            'HasVoiceCall' => true,
            'HasVideoCall' => true,
            'encrypt' => $encrypteddata
        ]);

        return $chat;
    }

    public function CkeckTimeSet($OldConsultationsTimes, $request)
    {
        if ($OldConsultationsTimes) {
            foreach ($OldConsultationsTimes as $v) {
                if (isset($v['NotSliced'][$request->Date])) {
                    foreach ($v['NotSliced'][$request['Date']] as $key => $value) {
                        if ((($value['EndTime'] >= $request['StartTime']) && ($value['StartTime'] <= $request['StartTime'])) ||
                            (($value['EndTime'] >= $request['EndTime']) && ($value['StartTime'] <= $request['EndTime'])) ||
                            (($value['StartTime'] > $request['StartTime']) && ($value['EndTime'] < $request['EndTime']))
                        ) {
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }
}
