<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('short_desc');
            $table->text('description');
            $table->text('keywords');
            $table->text('description_seo');
            $table->text('categories')->nullable();
            $table->timestamps();
        });
        DB::table('blogs')->insert([
            [
                'title' => 'روانپزشکیِ کال منوچهری',
                'short_desc' => 'برای روان خود پزشک بیابید',
                'description' => '<p>هرکس خواست بیاد</p>

                <p>به روان شما خودآمد میگوییم.</p>

                <p><img alt="" src="http://localhost/projects/under%20the%20work/Back-end/omid_team/moshaverman/public/uploads/ckeditor/613421_1603283597.gif" style="height:220px; width:176px" /></p>',
                'keywords' => 'خوش , روانپزشک , پزشک',
                'description_seo' => 'رتبه ی اول گوگل',
                'categories' => 'بی خوابی',
            ],
            [
                'title' => 'چطور بهترین دارو را برای روان خود تهیه کنیم؟',
                'short_desc' => 'تا توانی دلی بدست آور، دل شکستن هنر نمیباشد',
                'description' => '<p>جوینده یابنده است.</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>یک توضیحات دیگر</p>

                <p>&nbsp;</p>',
                'keywords' => 'کلید',
                'description_seo' => 'گوگل',
                'categories' => 'بی خوابی',
            ],
            [
                'title' => 'چطور بهترین پزشک را برای خود بیابیم',
                'short_desc' => 'از مهم ترین ملاک های پزشک...',
                'description' => '<p>پزشک خوب، میتواند در سایت مشاور من به وفور یافت شود.</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p><img alt="" src="http://localhost/projects/under%20the%20work/Back-end/omid_team/moshaverman/public/uploads/ckeditor/275223_1603283765.jpg" style="height:332px; width:500px" /></p>',
                'keywords' => 'خواب',
                'description_seo' => 'بهترین سایت گوگل',
                'categories' => 'الزایمر',
            ],
            [
                'title' => 'مقاله ی کاربردی',
                'short_desc' => 'توضیحات کاربردید',
                'description' => '<p>توضیحات کاربردی</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p>توضیحات</p>',
                'keywords' => 'کلید',
                'description_seo' => 'سئو',
                'categories' => 'روانالزایمر',
            ],
            [
                'title' => 'روانپزشکیِ کال منوچهری',
                'short_desc' => 'برای روان خود پزشک بیابید',
                'description' => '<p>هرکس خواست بیاد</p>

                <p>به روان شما خودآمد میگوییم.</p>

                <p><img alt="" src="http://localhost/projects/under%20the%20work/Back-end/omid_team/moshaverman/public/uploads/ckeditor/613421_1603283597.gif" style="height:220px; width:176px" /></p>',
                'keywords' => 'خوش , روانپزشک , پزشک',
                'description_seo' => 'رتبه ی اول گوگل',
                'categories' => 'بی خوابی',
            ],
            [
                'title' => 'روانپزشکیِ کال منوچهری',
                'short_desc' => 'برای روان خود پزشک بیابید',
                'description' => '<p>هرکس خواست بیاد</p>

                <p>به روان شما خودآمد میگوییم.</p>

                <p><img alt="" src="http://localhost/projects/under%20the%20work/Back-end/omid_team/moshaverman/public/uploads/ckeditor/613421_1603283597.gif" style="height:220px; width:176px" /></p>',
                'keywords' => 'خوش , روانپزشک , پزشک',
                'description_seo' => 'رتبه ی اول گوگل',
                'categories' => 'بی خوابی',
            ],
            [
                'title' => 'روانپزشکیِ کال منوچهری',
                'short_desc' => 'برای روان خود پزشک بیابید',
                'description' => '<p>هرکس خواست بیاد</p>

                <p>به روان شما خودآمد میگوییم.</p>

                <p><img alt="" src="http://localhost/projects/under%20the%20work/Back-end/omid_team/moshaverman/public/uploads/ckeditor/613421_1603283597.gif" style="height:220px; width:176px" /></p>',
                'keywords' => 'خوش , روانپزشک , پزشک',
                'description_seo' => 'رتبه ی اول گوگل',
                'categories' => 'بی خوابی',
            ],
            [
                'title' => 'روانپزشکیِ کال منوچهری',
                'short_desc' => 'برای روان خود پزشک بیابید',
                'description' => '<p>هرکس خواست بیاد</p>

                <p>به روان شما خودآمد میگوییم.</p>

                <p><img alt="" src="http://localhost/projects/under%20the%20work/Back-end/omid_team/moshaverman/public/uploads/ckeditor/613421_1603283597.gif" style="height:220px; width:176px" /></p>',
                'keywords' => 'خوش , روانپزشک , پزشک',
                'description_seo' => 'رتبه ی اول گوگل',
                'categories' => 'بی خوابی',
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
        Schema::dropIfExists('blogs');
    }
}
