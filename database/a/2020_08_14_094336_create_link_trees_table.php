<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_trees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('picture')->nullable();
            $table->string('bg_color')->nullable();

            $table->string('profile_picture_option')->nullable();
            $table->string('link_name_option')->nullable();
            $table->string('logo_option')->nullable();
            $table->bigInteger('user_id')->unsigned();

            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('link_trees')->insert([
        	'picture' => '1597404413957.jpeg',
	        'bg_color' => '#fff',
	        'profile_picture_option' => '1',
	        'link_name_option' => '1',
	        'logo_option' => '1',
	        'user_id' => '12',
        ]);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_trees');
    }
}
