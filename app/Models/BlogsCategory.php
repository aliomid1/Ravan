<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogsCategory extends Model
{
    protected $guarded = [];

    public function GetSubjects($title)
    {
        $result = collect();
        foreach (Blog::get() as $item) {
            $BlogCategories = explode(',' , $item->categories);
                if(in_array($title , $BlogCategories)){
                  $result->push($item);
                }
            }
            return $result;
    }

}
