<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdvisorsRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisors_requests', function (Blueprint $table) {
            $table->id();
            $table->text('advisor_form')->nullable();
            $table->timestamps();
        });

        DB::table('advisors_requests')->insert([
            [
                'advisor_form' => '{"_token":"9kpEszYmKv5TicrkB113uyguFTmIB38QIM0hHGEw","rahe_artabat":"\u0627\u06cc\u0646\u062a\u0631\u0646\u062a","angize":"\u0645\u0634\u0627\u0648\u0631\u0647 \u062f\u0627\u062f\u0646","name":"\u0645\u062d\u0645\u062f","famil":"\u0627\u0645\u06cc\u0646","gensiat":"\u0645\u0631\u062f","taahhol":"\u0645\u062c\u0631\u062f","rooz_tavallod":"32","mah_tavallod":"3","sal_tavallod":"99","shahr_sokunat":"\u0634\u0647\u0631 \u0645\u0634\u0627\u0648\u0631\u0647","vaziat_shoghl":"\u0628\u0644\u0647","name_kar":"\u062f\u0641\u062a\u0631 \u06a9\u0627\u0631","mahal_kar":"\u0628\u06cc\u062e \u06a9\u0627\u0644","adress_sokunat":"\u0646\u0628\u0634 \u06a9\u0627\u0644","email":"\u067e\u0633\u062a \u0627\u0644\u06a9\u062a\u0631\u0648\u0646\u06cc\u06a9","telephon_sabet":"021","telephone_hamrah":"091","madrak_tahsil":"\u0644\u06cc\u0633\u0627\u0646\u0633","gerayesh_tahsil":"\u0645\u0634\u0627\u0648\u0631\u0647 \u0627\u0642\u062a\u0635\u0627\u062f\u06cc","daneshgah":"\u0641\u0631\u062f\u0648\u0633\u06cc","ashnaii_englisi":"\u0632\u06cc\u0627\u062f","sayere_zaban_ha":"\u0639\u0631\u0628\u06cc\u060c \u0641\u0631\u0627\u0646\u0633\u0647\u060c \u0641\u0627\u0631\u0633\u06cc","ashnaii_rayane":"\u062e\u0648\u0628","sayere_etelaat_mofid":null,"vazayef_shoghl_ghabl":"\u0645\u0634\u0627\u0648\u0631\u0647","rooz_shoru_kar_ba_ma":"23","mah_shoru_kar_ba_ma":"11","sal_shoru_kar_ba_ma":"99","tarefe_daghighe":"50000","taiid":"\u0628\u0644\u0647","x":"63","y":"-3","resume":["uploads\/AdvisorsRequest\/85\/1610447056004.jpg","uploads\/AdvisorsRequest\/85\/1610447056005.jpg","uploads\/AdvisorsRequest\/85\/1610447056006.jpg"],"madrak_tahsili":["uploads\/AdvisorsRequest\/85\/1610447056018.jpg","uploads\/AdvisorsRequest\/85\/1610447057019.jpg","uploads\/AdvisorsRequest\/85\/1610447057020.jpg"],"parvane_eshteghal":["uploads\/AdvisorsRequest\/85\/1610447057028.jpg","uploads\/AdvisorsRequest\/85\/1610447057029.jpg","uploads\/AdvisorsRequest\/85\/1610447057030.jpg","uploads\/AdvisorsRequest\/85\/1610447057031.jpg","uploads\/AdvisorsRequest\/85\/1610447057032.jpg","uploads\/AdvisorsRequest\/85\/1610447058033.jpg","uploads\/AdvisorsRequest\/85\/1610447058034.jpg","uploads\/AdvisorsRequest\/85\/1610447058035.jpg","uploads\/AdvisorsRequest\/85\/1610447058036.jpg","uploads\/AdvisorsRequest\/85\/1610447058037.jpg"],"aks":["uploads\/AdvisorsRequest\/85\/1610447058018.jpg","uploads\/AdvisorsRequest\/85\/1610447058019.jpg","uploads\/AdvisorsRequest\/85\/1610447059020.jpg"]}',

            ],
            [
                'advisor_form' => '{"_token":"9kpEszYmKv5TicrkB113uyguFTmIB38QIM0hHGEw","rahe_artabat":"\u0627\u06cc\u0646\u062a\u0631\u0646\u062a","angize":"\u0645\u0634\u0627\u0648\u0631\u0647 \u062f\u0627\u062f\u0646","name":"\u0645\u062d\u0645\u062f","famil":"\u0627\u0645\u06cc\u0646","gensiat":"\u0645\u0631\u062f","taahhol":"\u0645\u062c\u0631\u062f","rooz_tavallod":"32","mah_tavallod":"3","sal_tavallod":"99","shahr_sokunat":"\u0634\u0647\u0631 \u0645\u0634\u0627\u0648\u0631\u0647","vaziat_shoghl":"\u0628\u0644\u0647","name_kar":"\u062f\u0641\u062a\u0631 \u06a9\u0627\u0631","mahal_kar":"\u0628\u06cc\u062e \u06a9\u0627\u0644","adress_sokunat":"\u0646\u0628\u0634 \u06a9\u0627\u0644","email":"\u067e\u0633\u062a \u0627\u0644\u06a9\u062a\u0631\u0648\u0646\u06cc\u06a9","telephon_sabet":"021","telephone_hamrah":"091","madrak_tahsil":"\u0644\u06cc\u0633\u0627\u0646\u0633","gerayesh_tahsil":"\u0645\u0634\u0627\u0648\u0631\u0647 \u0627\u0642\u062a\u0635\u0627\u062f\u06cc","daneshgah":"\u0641\u0631\u062f\u0648\u0633\u06cc","ashnaii_englisi":"\u0632\u06cc\u0627\u062f","sayere_zaban_ha":"\u0639\u0631\u0628\u06cc\u060c \u0641\u0631\u0627\u0646\u0633\u0647\u060c \u0641\u0627\u0631\u0633\u06cc","ashnaii_rayane":"\u062e\u0648\u0628","sayere_etelaat_mofid":null,"vazayef_shoghl_ghabl":"\u0645\u0634\u0627\u0648\u0631\u0647","rooz_shoru_kar_ba_ma":"23","mah_shoru_kar_ba_ma":"11","sal_shoru_kar_ba_ma":"99","tarefe_daghighe":"50000","taiid":"\u0628\u0644\u0647","x":"63","y":"-3","resume":["uploads\/AdvisorsRequest\/85\/1610447056004.jpg","uploads\/AdvisorsRequest\/85\/1610447056005.jpg","uploads\/AdvisorsRequest\/85\/1610447056006.jpg"],"madrak_tahsili":["uploads\/AdvisorsRequest\/85\/1610447056018.jpg","uploads\/AdvisorsRequest\/85\/1610447057019.jpg","uploads\/AdvisorsRequest\/85\/1610447057020.jpg"],"parvane_eshteghal":["uploads\/AdvisorsRequest\/85\/1610447057028.jpg","uploads\/AdvisorsRequest\/85\/1610447057029.jpg","uploads\/AdvisorsRequest\/85\/1610447057030.jpg","uploads\/AdvisorsRequest\/85\/1610447057031.jpg","uploads\/AdvisorsRequest\/85\/1610447057032.jpg","uploads\/AdvisorsRequest\/85\/1610447058033.jpg","uploads\/AdvisorsRequest\/85\/1610447058034.jpg","uploads\/AdvisorsRequest\/85\/1610447058035.jpg","uploads\/AdvisorsRequest\/85\/1610447058036.jpg","uploads\/AdvisorsRequest\/85\/1610447058037.jpg"],"aks":["uploads\/AdvisorsRequest\/85\/1610447058018.jpg","uploads\/AdvisorsRequest\/85\/1610447058019.jpg","uploads\/AdvisorsRequest\/85\/1610447059020.jpg"]}',
            ],
            [
                '{"_token":"9kpEszYmKv5TicrkB113uyguFTmIB38QIM0hHGEw","rahe_artabat":"\u0627\u06cc\u0646\u062a\u0631\u0646\u062a","angize":"\u0645\u0634\u0627\u0648\u0631\u0647 \u062f\u0627\u062f\u0646","name":"\u0645\u062d\u0645\u062f","famil":"\u0627\u0645\u06cc\u0646","gensiat":"\u0645\u0631\u062f","taahhol":"\u0645\u062c\u0631\u062f","rooz_tavallod":"32","mah_tavallod":"3","sal_tavallod":"99","shahr_sokunat":"\u0634\u0647\u0631 \u0645\u0634\u0627\u0648\u0631\u0647","vaziat_shoghl":"\u0628\u0644\u0647","name_kar":"\u062f\u0641\u062a\u0631 \u06a9\u0627\u0631","mahal_kar":"\u0628\u06cc\u062e \u06a9\u0627\u0644","adress_sokunat":"\u0646\u0628\u0634 \u06a9\u0627\u0644","email":"\u067e\u0633\u062a \u0627\u0644\u06a9\u062a\u0631\u0648\u0646\u06cc\u06a9","telephon_sabet":"021","telephone_hamrah":"091","madrak_tahsil":"\u0644\u06cc\u0633\u0627\u0646\u0633","gerayesh_tahsil":"\u0645\u0634\u0627\u0648\u0631\u0647 \u0627\u0642\u062a\u0635\u0627\u062f\u06cc","daneshgah":"\u0641\u0631\u062f\u0648\u0633\u06cc","ashnaii_englisi":"\u0632\u06cc\u0627\u062f","sayere_zaban_ha":"\u0639\u0631\u0628\u06cc\u060c \u0641\u0631\u0627\u0646\u0633\u0647\u060c \u0641\u0627\u0631\u0633\u06cc","ashnaii_rayane":"\u062e\u0648\u0628","sayere_etelaat_mofid":null,"vazayef_shoghl_ghabl":"\u0645\u0634\u0627\u0648\u0631\u0647","rooz_shoru_kar_ba_ma":"23","mah_shoru_kar_ba_ma":"11","sal_shoru_kar_ba_ma":"99","tarefe_daghighe":"50000","taiid":"\u0628\u0644\u0647","x":"63","y":"-3","resume":["uploads\/AdvisorsRequest\/85\/1610447056004.jpg","uploads\/AdvisorsRequest\/85\/1610447056005.jpg","uploads\/AdvisorsRequest\/85\/1610447056006.jpg"],"madrak_tahsili":["uploads\/AdvisorsRequest\/85\/1610447056018.jpg","uploads\/AdvisorsRequest\/85\/1610447057019.jpg","uploads\/AdvisorsRequest\/85\/1610447057020.jpg"],"parvane_eshteghal":["uploads\/AdvisorsRequest\/85\/1610447057028.jpg","uploads\/AdvisorsRequest\/85\/1610447057029.jpg","uploads\/AdvisorsRequest\/85\/1610447057030.jpg","uploads\/AdvisorsRequest\/85\/1610447057031.jpg","uploads\/AdvisorsRequest\/85\/1610447057032.jpg","uploads\/AdvisorsRequest\/85\/1610447058033.jpg","uploads\/AdvisorsRequest\/85\/1610447058034.jpg","uploads\/AdvisorsRequest\/85\/1610447058035.jpg","uploads\/AdvisorsRequest\/85\/1610447058036.jpg","uploads\/AdvisorsRequest\/85\/1610447058037.jpg"],"aks":["uploads\/AdvisorsRequest\/85\/1610447058018.jpg","uploads\/AdvisorsRequest\/85\/1610447058019.jpg","uploads\/AdvisorsRequest\/85\/1610447059020.jpg"]}',
            ],
            [
                'advisor_form' => '{"_token":"9kpEszYmKv5TicrkB113uyguFTmIB38QIM0hHGEw","rahe_artabat":"\u0627\u06cc\u0646\u062a\u0631\u0646\u062a","angize":"\u0645\u0634\u0627\u0648\u0631\u0647 \u062f\u0627\u062f\u0646","name":"\u0645\u062d\u0645\u062f","famil":"\u0627\u0645\u06cc\u0646","gensiat":"\u0645\u0631\u062f","taahhol":"\u0645\u062c\u0631\u062f","rooz_tavallod":"32","mah_tavallod":"3","sal_tavallod":"99","shahr_sokunat":"\u0634\u0647\u0631 \u0645\u0634\u0627\u0648\u0631\u0647","vaziat_shoghl":"\u0628\u0644\u0647","name_kar":"\u062f\u0641\u062a\u0631 \u06a9\u0627\u0631","mahal_kar":"\u0628\u06cc\u062e \u06a9\u0627\u0644","adress_sokunat":"\u0646\u0628\u0634 \u06a9\u0627\u0644","email":"\u067e\u0633\u062a \u0627\u0644\u06a9\u062a\u0631\u0648\u0646\u06cc\u06a9","telephon_sabet":"021","telephone_hamrah":"091","madrak_tahsil":"\u0644\u06cc\u0633\u0627\u0646\u0633","gerayesh_tahsil":"\u0645\u0634\u0627\u0648\u0631\u0647 \u0627\u0642\u062a\u0635\u0627\u062f\u06cc","daneshgah":"\u0641\u0631\u062f\u0648\u0633\u06cc","ashnaii_englisi":"\u0632\u06cc\u0627\u062f","sayere_zaban_ha":"\u0639\u0631\u0628\u06cc\u060c \u0641\u0631\u0627\u0646\u0633\u0647\u060c \u0641\u0627\u0631\u0633\u06cc","ashnaii_rayane":"\u062e\u0648\u0628","sayere_etelaat_mofid":null,"vazayef_shoghl_ghabl":"\u0645\u0634\u0627\u0648\u0631\u0647","rooz_shoru_kar_ba_ma":"23","mah_shoru_kar_ba_ma":"11","sal_shoru_kar_ba_ma":"99","tarefe_daghighe":"50000","taiid":"\u0628\u0644\u0647","x":"63","y":"-3","resume":["uploads\/AdvisorsRequest\/85\/1610447056004.jpg","uploads\/AdvisorsRequest\/85\/1610447056005.jpg","uploads\/AdvisorsRequest\/85\/1610447056006.jpg"],"madrak_tahsili":["uploads\/AdvisorsRequest\/85\/1610447056018.jpg","uploads\/AdvisorsRequest\/85\/1610447057019.jpg","uploads\/AdvisorsRequest\/85\/1610447057020.jpg"],"parvane_eshteghal":["uploads\/AdvisorsRequest\/85\/1610447057028.jpg","uploads\/AdvisorsRequest\/85\/1610447057029.jpg","uploads\/AdvisorsRequest\/85\/1610447057030.jpg","uploads\/AdvisorsRequest\/85\/1610447057031.jpg","uploads\/AdvisorsRequest\/85\/1610447057032.jpg","uploads\/AdvisorsRequest\/85\/1610447058033.jpg","uploads\/AdvisorsRequest\/85\/1610447058034.jpg","uploads\/AdvisorsRequest\/85\/1610447058035.jpg","uploads\/AdvisorsRequest\/85\/1610447058036.jpg","uploads\/AdvisorsRequest\/85\/1610447058037.jpg"],"aks":["uploads\/AdvisorsRequest\/85\/1610447058018.jpg","uploads\/AdvisorsRequest\/85\/1610447058019.jpg","uploads\/AdvisorsRequest\/85\/1610447059020.jpg"]}',
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
        Schema::dropIfExists('advisors_requests');
    }
}