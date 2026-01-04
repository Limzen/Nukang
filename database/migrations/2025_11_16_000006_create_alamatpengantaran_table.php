<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlamatpengantaranTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alamatpelanggan', function(Blueprint $table)
		{
			$table->increments('id_alamatpelanggan');
			$table->integer('id_pelanggan');
			$table->text('alamatpelanggan');
			$table->string('latitudealamat',30);
			$table->string('longtitudealamat',30);
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
		Schema::drop('alamatpengantaran');
	}

}
