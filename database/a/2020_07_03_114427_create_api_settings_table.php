<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('stripe_mode',['live','sandbox'])->nullable();
            $table->string('stripe_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('stripe_webhook_signing_secret_key')->nullable();
            $table->enum('stripe_enable_recurring_payment',['Yes','No'])->nullable();
            $table->enum('paypal_mode',['live','sandbox'])->nullable();
            $table->string('paypal_client_id')->nullable();
            $table->string('paypal_client_secret')->nullable();
            $table->string('paypal_webhook')->nullable();
            $table->enum('paypal_enable_subscription',['Yes','No'])->nullable();
            $table->string('google_api_key')->nullable();
            $table->string('google_client_id')->nullable();
            $table->string('dropbox_api_key')->nullable();
            $table->string('onedrive_client_id')->nullable();
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
        Schema::dropIfExists('api_settings');
    }
}
