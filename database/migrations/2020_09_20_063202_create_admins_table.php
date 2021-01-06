<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->text('username');
            $table->text('profile');
            $table->text('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('admins')->insert(
            [
                'username'=>'09150726835',
                'profile'=>'uploads/Admin//1609865703beiheng-guo-IAVVv6z3D6g-unsplash.jpg',
                'password'=>'$2y$10$$2y$10$eytUKB6NtwcuvsFpUVRjXup80YuOk9X1JWs9fp8HUbYxjBZ5itry2',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
