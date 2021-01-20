<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->text('chat_id')->nullable();
            $table->text('plan_id')->nullable();
            $table->text('user_id')->nullable();
            $table->text('advisor_id')->nullable();
            $table->text('price');
            $table->text('status');
            $table->text('transid')->nullable();
            $table->text('refid')->nullable();
            $table->text('cardnumber')->nullable();
            $table->text('trackingcode')->nullable();
            $table->text('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
