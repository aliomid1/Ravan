<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $guarded =[];
    public function GetUser()
    {
      return $this->hasOne(User::class,'id','user_id');
    }
}
