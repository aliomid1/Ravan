<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\Models\Payment;



class Advisors extends Authenticatable
{
    protected $guarded = [];


    
    public function Profile()
    {
        $one = $this->hasOne(Image::class, 'item_id', 'id');
        return $one->where('type', 'profile_advisor');
    }



    public function Payment()
    {
        return $this->hasMany(Payment::class, 'advisor_id', 'id');
    }



    public function Conversation()
    {
        $All = $this->hasMany(Conversation::class, 'advisor_id', 'id');
        return $All->where('status', 'done');
    }



    public function Comment()
    {
        return $this->hasMany(Comment::class, 'advisor_id', 'id');
    }
}
