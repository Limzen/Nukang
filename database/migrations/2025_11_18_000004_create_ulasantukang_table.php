<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUlasantukangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ulasan', function(Blueprint $table)
		{
			$table->increments('id_ulasan');
			$table->integer('id_tukang');
			$table->integer('id_pelanggan');
			$table->integer('rating');
			$table->text('isiulasan');
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
		Schema::drop('ulasan');
	}

}
