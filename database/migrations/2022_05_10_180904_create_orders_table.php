<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->double('total');
            $table->double('vat');
            $table->foreignId('coupon_id')->nullable();
            $table->double('coupon_value')->nullable();
            $table->string('coupon_type')->nullable();
            $table->double('final_total');
            $table->string('address');
            $table->enum('payment_status', ['processing','completed', 'canceled', 'refund'])->default('processing');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
