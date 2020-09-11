<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_id');
            $table->integer('customer_id')->nullable();
            $table->integer('supporter_id')->nullable();
            $table->longText('reply_body');
            $table->string('customer_attachment1')->nullable();
            $table->string('customer_attachment2')->nullable();
            $table->string('customer_attachment3')->nullable();
            $table->string('customer_attachment4')->nullable();
            $table->string('customer_attachment5')->nullable();
            $table->string('supporter_attachment1')->nullable();
            $table->string('supporter_attachment2')->nullable();
            $table->string('supporter_attachment3')->nullable();
            $table->string('supporter_attachment4')->nullable();
            $table->string('supporter_attachment5')->nullable();
            $table->boolean('is_supporter_replied')->default(0);
            $table->boolean('is_customer_replied')->default(0);
            $table->longText('supporter')->default(null);
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
        Schema::dropIfExists('ticket_replies');
    }
}
