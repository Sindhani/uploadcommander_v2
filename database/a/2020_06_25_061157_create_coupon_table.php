<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('package_id')->nullable();
            $table->enum('coupon_code_type', ['automatic','manual'])->nullable();
            $table->integer('no_of_coupon')->nullable();
            $table->string('coupon_code')->nullable();
            $table->enum('coupon_type',['percentage','absolute'])->nullable();
            $table->string('coupon_value')->nullable();
            $table->date('coupon_from_date')->nullable();
            $table->date('coupon_to_date')->nullable();
            $table->integer('coupon_code_used')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
