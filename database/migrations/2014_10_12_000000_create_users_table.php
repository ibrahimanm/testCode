<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
            $table->string('mobile',150);
            $table->string('email',150)->unique();
            $table->enum('type',['driver','delegate']);
            $table->enum('lang',['en','ar'])->default('ar');
            $table->enum('gender',['male','female']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',150);
            $table->string('personal_img',150);
            $table->boolean('active')->default(1);
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('nationality_id');
            $table->string('vehicle_type_img',150)->nullable();
            $table->enum('vehicle_type',['car','bicycle','motorcycle','van']);
            $table->unsignedInteger('number_of_passengers');
            $table->string('car_model',150)->nullable();
            $table->string('location',150);
            $table->date('dob');
            $table->enum('social_status',['single','married']);
            $table->string('scientific_degree',150);
            $table->string('speak_languages',150);
            $table->string('id_img',150);
            $table->string('car_licence_img',150)->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('device_token');
            $table->float('budget',8,2);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
