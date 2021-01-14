<?php

namespace App\Http\Controllers\Admins\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnfinishedConsultationsController extends Controller
{
    public function index()
    {
        return view('Admins.Unfinished.UnfinishedConsultations');
    }
}
