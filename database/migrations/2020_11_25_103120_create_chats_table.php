<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->boolean('used');
            $table->text('conversation_id');
            $table->text('user_id');
            $table->integer('expiretime');
            $table->text('expert_id');
            $table->text('user_name');
            $table->text('expert_name');
            $table->text('user_profile');
            $table->text('advisor_profile');
            $table->boolean('HasVoiceCall');
            $table->boolean('HasVideoCall');
            $table->text('encrypt');
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
        Schema::dropIfExists('chats');
    }
}
