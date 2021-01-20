<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
   protected $guarded =[];
   use HasPersianSlug;

   public function getSlugOptions(): SlugOptions
   {
       return SlugOptions::create()
           ->generateSlugsFrom('title')
           ->saveSlugsTo('slug');
   }
}
