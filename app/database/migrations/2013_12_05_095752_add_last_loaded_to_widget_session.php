<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLastLoadedToWidgetSession extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('widget_session', function(Blueprint $table) {
			$table->timestamp('last_loaded');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('widget_session', function(Blueprint $table) {
			$table->dropColumn('last_loaded');
		});
	}

}
