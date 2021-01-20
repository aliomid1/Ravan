<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdvisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisors', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('networks')->nullable();
            $table->text('mobile');
            $table->text('email')->nullable();
            $table->text('username');
            $table->text('password')->nullable();
            $table->text('category');
            $table->text('bio')->nullable();
            $table->text('education')->nullable();
            $table->text('resume')->nullable();
            $table->text('option')->nullable();
            $table->text('address')->nullable();
            $table->text('tel')->nullable();
            $table->text('price')->nullable();
            $table->text('consultations_times')->nullable();
            $table->integer('time_of_one_consultation')->nullable();
            $table->text('video')->nullable();
            $table->text('status')->nullable();
            $table->text('vip')->nullable();
            $table->timestamps();
        });
        DB::table('advisors')->insert([
            [
                'name' => 'آقای مشاور',
                'networks' => 'a:0:{}',
                'mobile' => '09156145545',
                'email' => 'a@gmail.com',
                'username' => 'moshaver1',
                'password' => '123456',
                'category' => '1',
                'bio' => 'سلام، مشاورم',
                'resume' => 'کارآفرین اجتماعی',
                'education' => 'لیسانس',
                'option' => 'مشاور روانشناسي',
                'address' => 'نيشابور، كنار كال',
                'tel' => '0514321',
                'price' => '800',
                'status' => '0',
                'vip' => '0',
            ],
            [
                'name' => ' آقای مشاور دهنده',
                'networks' => 'a:0:{}',
                'mobile' => '09150726835',
                'email' => 'a@gmail.com',
                'username' => 'moshaver2',
                'password' => '123456',
                'category' => '1',
                'bio' => 'سلام به همه',
                'resume' => 'کارآفرین اجتماعی',
                'education' => 'لیسانس',
                'option' => 'مشاور روانشناسي',
                'address' => 'نيشابور، كنار كال',
                'tel' => '0514321',
                'price' => '800',
                'status' => '0',
                'vip' => '0',
            ],
            [
                'name' => 'خانم مشاور',
                'networks' => 'a:0:{}',
                'mobile' => '09156145546',
                'email' => 'a@gmail.com',
                'username' => 'moshaver',
                'password' => '123456',
                'category' => '2',
                'bio' => 'سلام، مشاورم',
                'resume' => 'کارآفرین اجتماعی',
                'education' => ' لیسانس',
                'option' => 'مشاور روانشناسي',
                'address' => 'نيشابور، كنار كال',
                'tel' => '0514321',
                'price' => '880',
                'status' => '1',
                'vip' => '1',
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
        Schema::dropIfExists('advisors');
    }
}
