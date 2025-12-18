<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesananbahanmaterialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemesananbahanmaterial', function(Blueprint $table)
		{
			$table->increments('id_pemesananbahanmaterial');
			$table->integer('id_bahanmaterial');
			$table->integer('id_pemesanan');
			$table->string('hargapemesananbahanmaterial',50);
			$table->integer('qtypembelian');
			$table->string('statuspembelian','1');
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
		Schema::drop('pemesananbahanmaterial');
	}

}
