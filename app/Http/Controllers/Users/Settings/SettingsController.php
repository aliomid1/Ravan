<?php

namespace App\Http\Controllers\Users\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function Profile()
    {
        return view('users.settings.Profile');
    }
}
