<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoBansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_ban', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_video')->unsigned();
			$table->foreign('id_video')->references('id')->on('video');
			$table->integer('id_reason')->unsigned();
			$table->foreign('id_reason')->references('id')->on('video_ban_reason');
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
		Schema::drop('video_ban');
	}

}
