<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlansAdvisor extends Model
{
    protected $guarded = [];

    public function Plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
}
