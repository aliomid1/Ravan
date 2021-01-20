<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->text('advantages')->nullable();
            $table->text('target')->nullable();
            $table->timestamps();
        });
        DB::table('about_us')->insert([
            [
                'title' => 'َمشاور من چیست و چه می‌کند؟',
                'description' => 'شرکت دانش بنیان مشاوره آنلاین مشوِرَپ در سال 1396 با حمایت پارک علم و فناوری به منظور در دسترس قرار دادن خدمات مشاوره آنلاین با هزینه و کیفیت مناسب آغاز به کار کرد و در سال 1397، به طور رسمی شروع به کار کرد و استقبال گسترده ای از این محصول صورت گرفت.',
                'image' => '',
                'advantages' => '[{"title":"\u0645\u0634\u0627\u0648\u0631\u0647 \u062f\u0631 \u0647\u0631 \u0632\u0645\u0627\u0646","short_desc":"\u0645\u0634\u0627\u0648\u0631\u0647 \u0622\u0646\u0644\u0627\u06cc\u0646 \u062f\u0631 \u0647\u0631 \u0633\u0627\u0639\u062a \u0627\u0632 \u0634\u0628\u0627\u0646\u0647 \u0631\u0648\u0632"},{"title":"\u0647\u0632\u06cc\u0646\u0647 \u0645\u0646\u0627\u0633\u0628","short_desc":"\u0647\u0632\u06cc\u0646\u0647 \u0641\u0648\u0642\u200c\u0627\u0644\u0639\u0627\u062f\u0647 \u0645\u0642\u0631\u0648\u0646 \u0628\u0647 \u0635\u0631\u0641\u0647 \u0646\u0633\u0628\u062a \u0628\u0647 \u0645\u0634\u0627\u0648\u0631\u0647 \u062d\u0636\u0648\u0631\u06cc"},{"title":"\u06a9\u0627\u0631\u0634\u0646\u0627\u0633\u0627\u0646 \u0645\u062a\u062e\u0635\u0635 \u0645\u0634\u0627\u0648\u0631\u0647","short_desc":"\u0627\u062a\u0635\u0627\u0644 \u0628\u0647 \u0645\u0634\u0627\u0648\u0631 \u0645\u062a\u062e\u0635\u0635 \u062f\u0631 \u062d\u0648\u0632\u0647 \u0645\u0648\u0631\u062f\u200c\u0646\u0638\u0631"},{"title":"\u0645\u0634\u0627\u0648\u0631\u0647 \u0645\u062d\u0631\u0645\u0627\u0646\u0647","short_desc":"\u0645\u0634\u0627\u0648\u0631\u0647 \u0628\u0647\u200c\u0635\u0648\u0631\u062a \u06a9\u0627\u0645\u0644\u0627 \u0645\u062d\u0631\u0645\u0627\u0646\u0647"}]',
                'target' => 'هدف ما، ارائه خدمات مشاوره: با استفاده از مشاورین متخصص و مجرب به صورت در دسترس، در هر موقعیت جغرافیایی در زمینه های پزشکی، روانشناسی ، حقوقی و تحصیلی می باشد.',
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
        Schema::dropIfExists('about_us');
    }
}
