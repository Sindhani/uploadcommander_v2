<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpdesk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_menu')->default(1);
            $table->string('linked_page')->nullable();
            $table->string('assignment')->nullable();
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('creater');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('helpdesk');
    }
}
