<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];

    public function GetSubjects($title)
    {
        $result = collect();
        foreach (Subject::get() as $item) {
            $SubjectCategories = explode(',' , $item->categories);
            // dd($title, $SubjectCategories , in_array($title , $SubjectCategories));
                if(in_array($title , $SubjectCategories)){
                  $result->push($item);
                }
            }
            // dd($result);
            return $result;
        // return $this->hasMany(Subject::class, 'category_id', 'id');
    }



    public function Blogs($title)
    {
        $result = collect();
        foreach (Blog::get() as $item) {
            $Categories = explode(',' , $item->categories);
            if(in_array($title , $Categories)){
              $result->push($item);
            }
        }
        return $result;
    }



    public function Image()
    {
        $All = $this->hasOne(Image::class, 'item_id' , 'id' );
        return $All->where('type' , 'category');
    }

}
