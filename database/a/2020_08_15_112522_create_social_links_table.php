<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->bigIncrements('id');
	        $table->string('account')->nullable();
	        $table->string('account_name')->nullable();
	        $table->string('button_title')->nullable();
	        $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });
	    \Illuminate\Support\Facades\DB::table('social_links')->insert([

		    'account' => 'facebook',
		    'account_name' => 'noha1231234123',
		    'button_title' => 'button 1',
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
        Schema::dropIfExists('social_links');
    }
}
