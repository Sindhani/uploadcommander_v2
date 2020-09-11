<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_account_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->unsignedBigInteger('social_account_id')->nullable();
            $table->string('option_name')->nullable();
            $table->string('option_value')->nullable();
            $table->timestamps();

//            $table->foreign('customer_id')->references('id')->on('customers');
//            $table->foreign('social_account_id')->references('id')->on('social_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_account_options');
    }
}
