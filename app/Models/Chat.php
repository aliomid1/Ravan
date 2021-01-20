<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    public function UserImage()
    {
         $user_id_image =  $this->hasOne(Image::class , 'item_id' , 'user_id');
         return $user_id_image->where('type' , 'profile_user');
    }
    public function User()
    {
        return $this->hasOne('App\User' , 'id' , 'user_id');
    }


}
