<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function Conversation()
    {
        return $this->hasOne(Conversation::class, 'id', 'chat_id');
    }
}
