<?php

namespace App;

use App\Models\Conversation;
use App\Models\Image;
use App\Models\Wallet;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    public function Advisors()
    {
        return $this->hasMany(Conversation::class, 'user_id', 'id');
    }



    public function Wallet()
    {
        return $this->hasMany(Wallet::class, 'user_id' , 'id' );
    }



    public function Conversation()
    {
        $All = $this->hasMany(Conversation::class, 'user_id' , 'id' );
        return $All->where('status' , 'done');
    }



    public function Image()
    {
        $All = $this->hasOne(Image::class, 'item_id' , 'id' );
        return $All->where('type' , 'user');
    }
}
