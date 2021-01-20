<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->text('user_id');
            $table->text('amount');
            $table->text('type');
            $table->timestamps();
        });

        DB::table('wallets')->insert([
            [
                'user_id' => '1',
                'amount' => '120000',
                'type' => 'friend',
            ],
            [
                'user_id' => '1',
                'amount' => '110000',
                'type' => 'friend',
            ],
            [
                'user_id' => '1',
                'amount' => '12000',
                'type' => 'deposit',
            ],
            [
                'user_id' => '2',
                'amount' => '120000',
                'type' => 'deposit',
            ],
            [
                'user_id' => '2',
                'amount' => '120000',
                'type' => 'deposit',
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
        Schema::dropIfExists('wallets');
    }
}
