<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJasatersediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jasatersedia', function(Blueprint $table)
		{
			$table->increments('id_jasatersedia');
			$table->integer('id_tukang');
			$table->integer('id_jenispemesanan');
			$table->string('biayajasatersedia',30);
			$table->string('jenisjasatersedia',1);
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
		Schema::drop('jasatersedia');
	}

}
