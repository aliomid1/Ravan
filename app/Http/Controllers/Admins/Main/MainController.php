<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use App\Models\Advisors;
use App\Models\Category;
use App\Models\GetWayTRX;
use App\Models\Settings;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function Dashboard()
    {
        $Advisors = Advisors::get();
        $Users = User::get();
        $trx = Transaction::get();

        $days2 = [];
        for ($i = 1; $i <= 30; $i++) {
            $days2 += [$i => Carbon::now()->subdays($i)];
        }
        $Income = '';

        foreach ($days2 as $key => $value) {
            $trx2 = $trx;
            if ($key == 1) {
                $Income .= $trx2->where('created_at', '<', Carbon::now())->where('created_at', '>=', $value)->sum('price') . ',';
            } else {
                $Income .= $trx2->where('created_at', '<', $value)->where('created_at', '>', $days2[$key == 30 ? 30 : $key + 1])->sum('price') . ',';
            
            }
        }
        $settings = Settings::find(1);
        $trxg = GetWayTRX::where('status', 'SUCCEED')->get();
        return view('Admins.Main.Dashboard', compact(['Advisors', 'Users', 'Income', 'trxg', 'settings']));
    }



    public function UsersList()
    {
        return view('Admins.Users.UsersList');
    }



    public function AdvisorsList()
    {
        return view('Admins.Advisors.AdvisorsList');
    }



    public function AddAdvisor()
    {
        return view('Admins.Advisors.AddAdvisor');
    }



    public function SubjectCategory()
    {
        return view('Admins.Subject.Category.index');
    }


    public function BlogsCategory()
    {
        return view('Admins.Blogs.Category.index');
    }


    public function Support()
    {
        return view('Admins.Support.index');
    }


    public function Subjects()
    {
        return view('Admins.Subject.index');
    }

    public function Questions()
    {
        return view('Admins.Question.index');
    }

    public function SettingGeneral()
    {
        return view('Admins.Settings.index');
    }
    public function App()
    {
        return view('Admins.Settings.App');
    }

    public function PagesManager()
    {
        return view('Admins.Pages.index');
    }
    public function PlansManager()
    {
        return view('Admins.Plans.index');
    }
}
