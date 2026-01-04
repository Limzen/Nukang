<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenispemesananTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jenispemesanan', function(Blueprint $table)
		{
			$table->increments('id_jenispemesanan');
			$table->integer('id_kategoritukang');
			$table->string('jenispemesanan',100);
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
		Schema::drop('jenispemesanan');
	}

}
