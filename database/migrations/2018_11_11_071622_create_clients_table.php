<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password',150);
            $table->string('name',150);
            $table->string('mobile',150)->unique();
            $table->string('email',150)->unique();
            $table->boolean('active')->default(1);
            $table->enum('lang',['en','ar'])->default('ar');
            $table->enum('gender',['male','female'])->nullable();
            $table->date('dob')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('profile_img',150)->nullable();
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
        Schema::dropIfExists('clients');
    }
}
