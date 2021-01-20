<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SubjectComments extends Model
{
    protected $guarded=[];

    public function User()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }

    public function Subject()
    {
        return $this->hasOne(Subject::class , 'id' , 'subject_id');
    }
}
