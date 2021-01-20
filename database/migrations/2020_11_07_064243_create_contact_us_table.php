<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->text('email');
            $table->text('phone');
            $table->text('address');
            $table->timestamps();
        });
        DB::table('contact_us')->insert([
            [
                'email' => 'info@mashverapp.com',
                'phone' => '۴۳۰۳۲۰۰۰',
                'address' => 'تهران، جردن، خیابان سعیدی',
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
        Schema::dropIfExists('contact_us');
    }
}
