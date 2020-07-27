<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
            $table->enum('type',['client','delegate','driver']);
            $table->timestamps();
        });

        \DB::table('complaint_reasons')->insert([

            [
                'id' => 1,
                'name' => "الطلب متأخر",
                'type' => "client",
            ],
            [
                'id' => 11,
                'name' => "السائق متأخر",
                'type' => "client",
            ],
            [
                'id' => 12,
                'name' => "السائق بطيئ",
                'type' => "client",
            ],
            [
                'id' => 2,
                'name' => "لم يتم تسليم الطلب",
                'type' => "client",
            ],
            [
                'id' => 3,
                'name' => "المندوب/السائق غير مهذب مزعج",
                'type' => "client",
            ],
            [
                'id' => 4,
                'name' => "سبب آخر",
                'type' => "client",
            ],

            [
                'id' => 5,
                'name' => "مكان العميل تغير",
                'type' => "delegate",
            ],
            [
                'id' => 6,
                'name' => "العميل غير مهذب",
                'type' => "delegate",
            ],
            [
                'id' => 7,
                'name' => "سبب آخر",
                'type' => "delegate",
            ],

            [
                'id' => 8,
                'name' => "مكان العميل تغير",
                'type' => "driver",
            ],
            [
                'id' => 9,
                'name' => "العميل غير مهذب",
                'type' => "driver",
            ],
            [
                'id' => 10,
                'name' => "سبب آخر",
                'type' => "driver",
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
        Schema::dropIfExists('complaint_reasons');
    }
}
