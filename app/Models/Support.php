<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
   protected $guarded =[];
   public function User()
   {
     return $this->hasOne(User::class,'id','user_id');
   }
}
