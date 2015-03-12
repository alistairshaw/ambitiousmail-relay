<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaigns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('campaign_name', 500);
			$table->string('subject_line', 500);
			$table->string('from_name', 500);
			$table->boolean('track_opens');
			$table->boolean('track_clicks');
			$table->text('html');
			$table->text('plaintext');
			$table->string('from_email', 500)->nullable();
			$table->string('reply_to_email', 500)->nullable();
			$table->string('bounce_email', 500)->nullable();
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
		Schema::drop('campaigns');
	}

}
