<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded=[];



    public function Image()
    {
        $All = $this->hasOne(Image::class, 'item_id' , 'id' );
        return $All->where('type' , 'subject');
    }



    public function Comments()
    {
        return $this->hasMany(SubjectComments::class, 'subject_id' , 'id' );
    }


    public function ConfirmedComments()
    {
        $All = $this->hasMany(SubjectComments::class, 'subject_id' , 'id' );
        return $All->where('publication' , 'on');
    }


    public function WaitingComments()
    {
        $All = $this->hasMany(SubjectComments::class, 'subject_id' , 'id' );
        return $All->where('publication' , null);
    }
}
