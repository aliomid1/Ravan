<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('user_id');
            $table->text('advisor_id');
            $table->text('score');
            $table->text('text');
            $table->text('status')->default('off');
            $table->text('publication')->default('off');
            $table->timestamps();
        });
        DB::table('comments')->insert([
            [
                'user_id' => '1',
                'advisor_id' => '1',
                'score' => '4',
                'text' => 'تستهای روانشناسی که به صورت حضوری باید صدها هزار تومن بابتش هزینه میکردم تو این
                اپلیکیشن به صورت رایگان در اختیارم قرار گرفت. واقعا باورنکردنی بود.',
                'status' => 'on',
                'publication' => 'on',
            ],
            [
                'user_id' => '2',
                'advisor_id' => '1',
                'score' => '5',
                'text' => 'من شهرستان زندگی میکنم ودسترسی به مشاوره خوب نداشتم ولی  مشاور من  این مشکل منو با
                مشاوره های حرفه ای و باسوادش حل کرد.',
                'status' => 'on',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'advisor_id' => '2',
                'score' => '4',
                'text' => 'خیلی دودل بودم که ازدواج کنم یا نه؟ برای هم مناسب هستیم یا نه؟ بعد از مشاوره
                خیلی مطمئن تر تونستم تصمیم بگیرم.',
                'status' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '2',
                'advisor_id' => '1',
                'score' => '4',
                'text' => 'پزشک های خوب رو برای این اپلیکیشن گلچین کرده. من که به شخصه از همه
                مشاوره هایی که گرفتم، خیلی راضی ام.',
                'status' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '2',
                'advisor_id' => '1',
                'score' => '4',
                'text' => 'خیلی با حوصله به حرف های بنده گوش دادند و نکات بسیار خوب و کاربردی رو برای حل
                مشکل من بیان کردند',
                'status' => 'off',
                'publication' => 'off',
            ],
            [
                'user_id' => '2',
                'advisor_id' => '1',
                'score' => '4',
                'text' => 'عالی بود واقعا با حوصله هستند و مشاوره صبورانه پیش میبرند و در ضمن پیگیری میکنند
                و راه حل هاشون همیشه برام مفید بوده و خیلی آروم شدم. ممنونم ازشون 😍 😍',
                'status' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'advisor_id' => '1',
                'score' => '4',
                'text' => 'خیلی دودل بودم که ازدواج کنم یا نه؟ برای هم مناسب هستیم یا نه؟ بعد از مشاوره
                خیلی مطمئن تر تونستم تصمیم بگیرم.',
                'status' => 'off',
                'publication' => 'on',
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
        Schema::dropIfExists('comments');
    }
}
