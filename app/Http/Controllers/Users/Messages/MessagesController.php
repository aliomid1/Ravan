<?php

namespace App\Http\Controllers\Users\Messages;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
        public function Chat()
        {
            return view('users.messages.Chat');
        }

        public function List()
        {
            return view('users.messages.List');
        }
}
