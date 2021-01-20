<?php

namespace App\Http\Controllers\Users\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportsController extends Controller
{
    public function List()
    {
        return view('users.support.List');
    }


    public function Support()
    {
        return view('users.support.support');
    }
}
