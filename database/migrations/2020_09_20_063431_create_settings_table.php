<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id('id');
            $table->text('title');
            $table->text('logo');
            $table->text('keywords');
            $table->text('description');
            $table->text('colorPrimary');
            $table->text('colorSecondary');
            $table->text('time_default');
            $table->text('price_default');
            $table->text('percent');
            $table->text('gift_default');
            $table->text('type_signUp_advisors');
            $table->text('type_signUp_users');
            $table->text('verify_email');
            $table->text('textmessage');
            $table->timestamps();
        });
        DB::table('settings')->insert([
            [
                'title' => 'مشاور من',
                'logo' => '',
                'keywords' => 'moshaver',
                'description' => '09156145545',
                'colorPrimary' => '#ff7300',
                'colorSecondary' => '#2db354',
                'time_default' => '20',
                'price_default' => '5000',
                'percent' => '12',
                'gift_default' => '1000',
                'type_signUp_advisors' => 'advisors',
                'type_signUp_users' => 'on',
                'verify_email' => 'on',
                'textmessage' => '',


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
        Schema::dropIfExists('settings');
    }
}
