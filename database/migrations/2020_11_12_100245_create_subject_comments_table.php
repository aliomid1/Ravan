<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSubjectCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_comments', function (Blueprint $table) {
            $table->id();
            $table->text('user_id')->nullable();
            $table->text('subject_id')->nullable();
            $table->text('text')->nullable();
            $table->text('replied')->nullable();
            $table->text('publication')->nullable();
            $table->timestamps();
        });

        DB::table('subject_comments')->insert([
            [
                'user_id' => '1',
                'subject_id' => '1',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '1',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '1',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '2',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '2',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '2',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '3',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '3',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '3',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '4',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '4',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '4',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '5',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '5',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
                'publication' => 'on',
            ],
            [
                'user_id' => '1',
                'subject_id' => '5',
                'text' => 'بعد مشاوره احصاس طراوت و شادابی میکنم، بنظرم خیلی مشاور و مشاوره ی خوبی بود، ممنون از سایت خوبتون',
                'replied' => 'off',
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
        Schema::dropIfExists('subject_comments');
    }
}
