<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('tickets.table_names');

        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_id');
            $table->integer('customer_id');
            $table->longText('ticket_subject');
            $table->longText('ticket_body');
            $table->string('attachment1')->nullable();
            $table->string('attachment2')->nullable();
            $table->string('attachment3')->nullable();
            $table->string('attachment4')->nullable();
            $table->string('attachment5')->nullable();
            $table->longText('ticket_status')->default('open');
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
        Schema::dropIfExists('tickets');
    }
}
