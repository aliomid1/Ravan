<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];



    public function Advisor()
    {
        return $this->hasOne(Advisors::class , 'id' , 'advisor_id');
    }

}
