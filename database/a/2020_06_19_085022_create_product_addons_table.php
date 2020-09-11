<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_addons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('addon_name')->nullable();
            $table->integer('social_account_limit')->nullable();
            $table->integer('file_storage_size')->nullable();
            $table->float('monthly_pricing')->nullable();
            $table->float('yearly_pricing')->nullable();
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
        Schema::dropIfExists('product_addons');
    }
}
