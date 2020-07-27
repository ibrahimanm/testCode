<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 11)->unique();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->unsignedInteger('client_id')->index();
            $table->enum('type', ['package', 'store']);
            $table->text('store_information')->nullable();
            $table->string('source_location')->comment('نقطة الانطلاق');
            $table->string('destination_location')->nullable()->comment('نقطة الوصول');
            $table->text('notes')->nullable();
            $table->text('images')->nullable();
            $table->unsignedInteger('deliver_duration')->default(0);
            $table->enum('status', ['new', 'in_way', 'delivery_confirm', 'reception_confirm', 'canceled']);
            $table->timestamp('status_updated_at');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->double('total_price')->default(0)->comment('المبلغ الكلي');
            $table->double('subtotal_price')->default(0)->comment('المبلغ الاجمالي (للدفع)');
            $table->double('package_price')->default(0)->comment('سعر الطرد');
            $table->double('discount_price')->default(0)->comment('سعر الخصم');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_orders');
    }
}
