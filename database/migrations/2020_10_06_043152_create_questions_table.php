<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('type')->nullable();
            $table->text('description');
            $table->timestamps();
        });

        DB::table('questions')->insert([
            [
                'title' => 'چطور میتوانم با مشاور من کار کنم؟',
                'type' => 'how',
                'description' => 'سلام و عرض ادب، به این صورت که...',
            ],
            [
                'title' => 'کار با روانشناسی',
                'type' => 'why',
                'description' => 'سلام، وقت بخیر',
            ],
            [
                'title' => 'چطور میتوانم با مشاور من کار کنم؟',
                'type' => 'how',
                'description' => 'سلام و عرض ادب، به این صورت که...',
            ],
            [
                'title' => 'کار با روانشناسی',
                'type' => 'why',
                'description' => 'سلام، وقت بخیر',
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
        Schema::dropIfExists('questions');
    }
}
