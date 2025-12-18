<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBahanmaterialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bahanmaterial', function(Blueprint $table)
		{
			$table->increments('id_bahanmaterial');
			$table->increments('id_kategoritukang');
			$table->string('kodebahanmaterial',10);
			$table->string('bahanmaterial',100);
			$table->text('informasibahanmaterial');
			$table->string('hargabahanmaterial',50);
			$table->string('fotobahanmaterial',50);
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
		Schema::drop('bahanmaterial');
	}

}
