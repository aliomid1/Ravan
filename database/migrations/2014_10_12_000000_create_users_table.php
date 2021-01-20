<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('fullname')->nullable();
            $table->string('username');
            $table->string('mobile')->unique();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('bio')->nullable();
            $table->string('verify_email')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            [
                'fullname'=>'محمد',
                'username'=>'1234',
                'mobile'=>'1234',
                'email'=>'1234@i.com',
                'password'=>'$2y$10$OpeSidSAYJvjbVWLPpdIKOVqgeKN86nRbLZpmcTf3ZRAYONHfuHNq',
                'bio'=>'salam',
            ],
            [
                'fullname'=>'Ali',
                'username'=>'ali',
                'mobile'=>'09150726835',
                'email'=>'ali@i.com',
                'password'=>'$2y$10$OpeSidSAYJvjbVWLPpdIKOVqgeKN86nRbLZpmcTf3ZRAYONHfuHNq',
                'bio'=>'salam',
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
        Schema::dropIfExists('users');
    }
}
