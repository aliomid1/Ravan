<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            // $table->text('short_description');
            $table->text('keywords_seo');
            $table->text('description_seo');
            $table->timestamps();
        });
        DB::table('categories')->insert([
            [            
            'title' => 'پزشکی',
            // 'short_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است',
            'keywords_seo' => 'پزشكي ، دكتري',
            'description_seo' => 'اين دسته بندي مربوط به پزشكي ميباشد',
            ],
            [            
            'title' => 'روانپزشکی',
            // 'short_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است',
            'keywords_seo' => 'روانپزشكي ، روانشناسي',
            'description_seo' => 'اين دسته بندي مربوط به روانپزشكي ميباشد',
            ],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
