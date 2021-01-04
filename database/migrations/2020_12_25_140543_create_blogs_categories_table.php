<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBlogsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_categories', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('keywords_seo');
            $table->text('description_seo');
            $table->timestamps();
        });

        DB::table('blogs_categories')->insert([
            [
            'title' => 'الزایمر',
            'keywords_seo' => 'پزشكي ، دكتري',
            'description_seo' => 'اين دسته بندي مربوط به پزشكي ميباشد',
            ],
            [
            'title' => 'بی خوابی',
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
        Schema::dropIfExists('blogs_categories');
    }
}
