<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->text('user_id');
            $table->text('advisor_id');
            $table->text('subject');
            $table->text('type');
            $table->text('price');
            $table->text('status');
            $table->text('time');
            $table->text('comment_status')->nullable();
            $table->text('code');
            $table->text('start_at');
            $table->timestamps();
        });
        DB::table('conversations')->insert([
            [
                'user_id' => '1',
                'advisor_id' => '1',
                'subject' => '4',
                'type' => 'online',
                'price' => '500',
                'status' => 'to_do',
                'time' => '25',
                'comment_status' => 'null',
                'code' => '34244',
                'start_at' => '24:00',
            ],
            [
                'user_id' => '1',
                'advisor_id' => '1',
                'subject' => '4',
                'type' => 'online',
                'price' => '500',
                'status' => 'doing',
                'time' => '25',
                'comment_status' => 'null',
                'code' => '34244',
                'start_at' => '24:00',
            ],
            [
                'user_id' => '1',
                'advisor_id' => '1',
                'subject' => '4',
                'type' => 'in',
                'price' => '500',
                'status' => 'done',
                'time' => '25',
                'comment_status' => 'off',
                'code' => '34244',
                'start_at' => '24:00',
            ],
            [
                'user_id' => '1',
                'advisor_id' => '1',
                'subject' => '4',
                'type' => 'online',
                'price' => '500',
                'status' => 'done',
                'time' => '25',
                'comment_status' => 'off',
                'code' => '34244',
                'start_at' => '24:00',
            ],
            [
                'user_id' => '1',
                'advisor_id' => '1',
                'subject' => '4',
                'type' => 'out',
                'price' => '500',
                'status' => 'done',
                'time' => '25',
                'comment_status' => 'on',
                'code' => '34244',
                'start_at' => '24:00',
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
        Schema::dropIfExists('conversations');
    }
}
