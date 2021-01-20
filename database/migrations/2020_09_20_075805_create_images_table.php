<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->text('type');
            $table->text('item_id');
            $table->timestamps();
        });
        DB::table('images')->insert([
            [
                'url' => 'assets/Web/images/133617_1492731.jpg',
                'type' => 'blogs',
                'item_id' => '1',
            ],
            [
                'url' => 'assets/Web/images/coronavirus_1.jpg',
                'type' => 'blogs',
                'item_id' => '2',
            ],
            [
                'url' => 'assets/Web/images/male-nose-fold1.jpg',
                'type' => 'blogs',
                'item_id' => '3',
            ],
            [
                'url' => 'assets/Web/images/sayk2.jpg',
                'type' => 'blogs',
                'item_id' => '4',
            ],
            [
                'url' => 'assets/Web/images/DRDM566023.jpg',
                'type' => 'blogs',
                'item_id' => '5',
            ],
            [
                'url' => 'assets/Web/images/c1hildhood-cancer-facts-and-symptoms.jpg',
                'type' => 'blogs',
                'item_id' => '6',
            ],
            [
                'url' => 'assets/Web/images/DRDM566023.jpg',
                'type' => 'blogs',
                'item_id' => '7',
            ],
            [
                'url' => 'assets/Web/images/coronavirus_1.jpg',
                'type' => 'blogs',
                'item_id' => '8',
            ],
            [
                'url' => 'assets/Web/images/login-bg.jpg',
                'type' => 'category',
                'item_id' => '1',
            ],
            [
                'url' => 'assets/Web/images/depression_consulting.jpg',
                'type' => 'category',
                'item_id' => '2',
            ],
            [
                'url' => 'assets/Web/images/2.png',
                'type' => 'user',
                'item_id' => '2',
            ],
            [
                'url' => 'assets/Web/images/3.jpg',
                'type' => 'user',
                'item_id' => '1',
            ],
            [
                'url' => 'uploads/Subjects//160516125216032837801.jpg',
                'type' => 'subject',
                'item_id' => '1',
            ],
            [
                'url' => 'uploads/Subjects//16051612651603109177Negar 05975 (1).jpg',
                'type' => 'subject',
                'item_id' => '2',
            ],
            [
                'url' => 'uploads/Subjects//1605161278header-image-low-size.png',
                'type' => 'subject',
                'item_id' => '3',
            ],
            [
                'url' => 'uploads/Subjects//1605161298160328367938.jpg',
                'type' => 'subject',
                'item_id' => '4',
            ],
            [
                'url' => 'uploads/Subjects//16051613104.jpg',
                'type' => 'subject',
                'item_id' => '5',
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
        Schema::dropIfExists('images');
    }
}
