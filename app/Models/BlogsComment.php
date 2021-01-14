<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
class BlogsComment extends Model
{
    protected $guarded = [];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Blog()
    {
        return $this->hasOne(Blog::class, 'id', 'subject_id');
    }   
}
